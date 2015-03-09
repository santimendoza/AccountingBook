<?php

namespace App\Models\Expenses;

use App\Models\DateFunctions;
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
        $firstdatestring = DateFunctions::firstDayOfMonthString($month, $year);
        $expenses = Expenses::where('expensesCategory_id', '=', $category->id)->where('date', '>=', $firstdatestring)->get();
        $totalexpenses = 0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        return $totalexpenses;
    }

    public static function calculateDifferenceBetweenDates($actmonth, $actyear, $prevmonth, $prevyear) {
        $actualFirstDateString = DateFunctions::firstDayOfMonthString($actmonth, $actyear);
        $actualLastDateString = DateFunctions::lastDayOfMonthString($actmonth, $actyear);
        $prevFirstDateString = DateFunctions::firstDayOfMonthString($prevmonth, $prevyear);
        $prevLastDateString = DateFunctions::lastDayOfMonthString($prevmonth, $prevyear);
        $expensesActualMonth = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $actualFirstDateString)->where('date', '<=', $actualLastDateString)->get();
        $expensesPrevMonth = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '>=', $prevFirstDateString)->where('date', '<=', $prevLastDateString)->get();
        $expensesamount1 = ExpensesFunctions::calculateTotalExpenses($expensesActualMonth);
        $expensesamount2 = ExpensesFunctions::calculateTotalExpenses($expensesPrevMonth);
        if ($expensesamount2 == 0) {
            return [0, 0]; //Si en el mes pasado no tuvo gastos, devolver 0 en diferencia.
        } else {
            $resultpercents = (($expensesamount1 / $expensesamount2) * 100) - 100;
            $resultdifference = $expensesamount1 - $expensesamount2;
            return [round($resultpercents, 2), $resultdifference];
        }
    }

}
