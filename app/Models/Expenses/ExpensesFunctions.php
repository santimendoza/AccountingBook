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

    public static function calculateDifferenceBetweenDates($actmonth, $actyear, $prevmonth, $prevyear) {
        $firstdatestring1 = DateFunctions::firstDayOfMonth($actmonth, $actyear);
        $lastdatestring1 = DateFunctions::lastDayOfMonth($actmonth, $actyear);
        $firstdatestring2 = DateFunctions::firstDayOfMonth($prevmonth, $prevyear);
        $lastdatestring2 = DateFunctions::lastDayOfMonth($prevmonth, $prevyear);
        $expensesmonth1 = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $firstdatestring1)->where('date', '<=', $lastdatestring1)->get();
        $expensesmonth2 = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $firstdatestring2)->where('date', '<=', $lastdatestring2)->get();
        $expensesamount1 = ExpensesFunctions::calculateTotalExpenses($expensesmonth1);
        $expensesamount2 = ExpensesFunctions::calculateTotalExpenses($expensesmonth2);
        if (count($expensesamount2) <= 1) {
            return [0, 0]; //Si en el mes pasado no tuvo gastos, devolver 0 en diferencia.
        } else {
            $resultpercents = (($expensesamount1 / $expensesamount2) * 100) - 100;
            $resultdifference = $expensesamount1 - $expensesamount2;
            return [round($resultpercents, 2), $resultdifference];
        }
    }

}
