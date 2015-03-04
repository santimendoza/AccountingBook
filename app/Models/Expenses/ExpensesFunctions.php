<?php

namespace App\Models\Expenses;

use App\Models\DateFunctions;
use App\Models\User;
use Auth;

class ExpensesFunctions {

    public static function calculateTotalExpenses($expenses) {
        $totalexpenses = 0.0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        return $totalexpenses;
    }

    public static function calculateExpensesCategory($category) {
        $month = date('n');
        $year = date('Y');
        $firstdatestring = DateFunctions::firstDayOfMonth($month, $year);
        $expenses = Expenses::where('expensesCategory_id', '=', $category->id)->where('date', '>=', $firstdatestring)->get();
        $totalexpenses = 0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        return $totalexpenses;
    }

    public static function calculatePorcentsBetweenDates($month1, $year1, $month2, $year2) {
        $firstdatestring1 = DateFunctions::firstDayOfMonth($month1, $year1);
        $lastdatestring1 = DateFunctions::lastDayOfMonth($month1, $year1);
        $firstdatestring2 = DateFunctions::firstDayOfMonth($month2, $year2);
        $lastdatestring2 = DateFunctions::lastDayOfMonth($month2, $year2);
        $expensesmonth1 = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $firstdatestring1)
                        ->where('date', '<=', $lastdatestring1)->get();
        $expensesmonth2 = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $firstdatestring2)
                        ->where('date', '<=', $lastdatestring2)->get();
        $expensesamount1 = ExpensesFunctions::calculateTotalExpenses($expensesmonth1);
        $expensesamount2 = ExpensesFunctions::calculateTotalExpenses($expensesmonth2);
        $resultpercents = (($expensesamount1 / $expensesamount2) * 100) - 100;
        $resultdifference = $expensesamount1 - $expensesamount2;
        return [round($resultpercents, 2),$resultdifference];
    }

}
