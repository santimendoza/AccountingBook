<?php

namespace App\Http\Controllers;

//use App\Http\Requests;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Earnings\Earnings;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\DateFunctions;
use App\Models\EarningsCategories\EarningsCategories;
use App\Models\ExpensesCategories\ExpensesCategories;
use Auth;

class DashboardController extends Controller {

    public function expensesCategoriesPercent() {
        $expenses = DashboardController::expenses();
        $earnings = DashboardController::earnings();
        $categoriessexpenses = DashboardController::categoriesWithExpenses();
        $differencePercentMonths = ExpensesFunctions::calculateDifferenceBetweenDates(date('n'), date('Y'), date('n') - 1, date('Y'));
        $data = [
            'expenses' => $expenses,
            'earnings' => $earnings,
            'categoriessexpenses' => $categoriessexpenses,
            'differencePercentMonths' => $differencePercentMonths[0],
            'differenceMonths' => $differencePercentMonths[1]
        ];
        return view('user.profile')->with($data);
    }

    public function expenses() {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $gastostotales = 0;
        $gastoscategoria = [];
        $expensescategories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        foreach ($expensescategories as $categories) {
            $gastos = 0;
            $expenses = Expenses::where('date', '>=', $monthstartdaystring)
                    ->where('expensesCategory_id', '=', $categories->id)
                    ->get();
            foreach ($expenses as $expense) {
                $gastos += $expense->amount;
            }
            $gastostotales += $gastos;
            $gastoscategoria[$categories->id] = $gastos;
        }
        $data = ['gastoscategoria' => $gastoscategoria, 'gastostotales' => $gastostotales];
        return $data;
    }

    public function earnings() {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $gastostotales = 0;
        $gastoscategoria = [];
        $earningscategories = EarningsCategories::where('user_id', '=', Auth::user()->id)->get();
        foreach ($earningscategories as $categories) {
            $ingresos = 0;
            $earnings = Earnings::where('earningsCategory_id', '=', $categories->id)
                    ->where('date', '>=', $monthstartdaystring)
                    ->get();
            foreach ($earnings as $earning) {
                $ingresos += $earning->amount;
            }
            $gastostotales += $ingresos;
            $gastoscategoria[$categories->id] = $ingresos;
        }
        $data = ['gastoscategoria' => $gastoscategoria, 'gastostotales' => $gastostotales];
        return $data;
    }

    public function categoriesWithExpenses() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return 0;
        }
        $superiorcategories = [];
        $categoriessuperior = [];
        $expensescategories = [];
        $totalcategories = 0;
        foreach ($categories as $category) {
            if ($category->superior_cat == null) {
                $superiorcategories[$category->id] = [];
                $expensecategory['amount'] = ExpensesFunctions::calculateExpensesCategory($category);
                $expensecategory['slug'] = $category->slug;
                $expensescategories[$category->id] = $expensecategory;
                array_push($categoriessuperior, $category);
                $totalcategories +=1;
            }
        }
        foreach ($categories as $category) {
            if ($category->superior_cat != null) {
                $expensescategories[$category->superior_cat]['amount'] += ExpensesFunctions::calculateExpensesCategory($category);
            }
        }
        return $expensescategories;
    }

}
