<?php

namespace App\Models\ExpensesCategories;

use Auth;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\Savings\Savings;

class ExpensesCategoriesFunctions {

    public static function getCategoriesAndSubcategories() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return 0;
        }
        $superiorcategories = [];
        $categoriessuperior = [];
        $totalcategories = 0;
        foreach ($categories as $category) {
            if ($category->superior_cat == null) {
                $superiorcategories[$category->id] = [];
                array_push($categoriessuperior, $category);
                $totalcategories +=1;
            }
        }
        foreach ($categories as $category) {
            if ($category->superior_cat != null) {
                array_push($superiorcategories[$category->superior_cat], $category);
            }
        }
        $categoriesarray[0] = $categoriessuperior;
        $categoriesarray[1] = $superiorcategories;

        return $categoriesarray;
    }

    public static function getTotalBudget() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)
                ->whereNull('superior_cat')
                ->get();
        $savings = Savings::where('user_id', '=', Auth::user()->id)->get();
        $totalBudget = 0;
        if (count($categories) > 1) {
            foreach ($categories as $category) {
                $totalBudget += $category->budget;
            }
        }
        if(count($savings) >= 1){
            foreach ($savings as $saving) {
                $totalBudget += $saving->budget;
            }
        }
        return $totalBudget;
    }

}
