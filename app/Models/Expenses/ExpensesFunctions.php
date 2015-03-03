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
        $m = date('n');
        $monthstartday = date('Y-m-d', mktime(1, 1, 1, $m, 1, date('Y')));
        $monthendday = date('Y-m-d', mktime(1, 1, 1, $m + 1, 0, date('Y')));
        $monthstartdaystring = str_replace('-', '', $monthstartday);
        $monthenddaystring = str_replace('-', '', $monthendday);
        $expenses = Expenses::where('expensesCategory_id', '=', $category->id)->where('date', '>=', $monthstartdaystring)->get();
        $totalexpenses = 0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }

        return $totalexpenses;
    }

}
