<?php

namespace App\Models\Expenses;

class ExpensesFunctions {

    public static function calculateTotalExpenses($expenses) {
        $totalexpenses = 0.0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        return $totalexpenses;
    }

    public static function calculateExpensesCategory($category) {
        $expenses = Expenses::where('expensesCategory_id', '=', $category->id)->get();
        $totalexpenses = 0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        
        return $totalexpenses;
    }

}
