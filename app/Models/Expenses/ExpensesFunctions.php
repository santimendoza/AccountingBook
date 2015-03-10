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
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
//        $monthstartday = $dates[0];
//        $monthendday = $dates[1];
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $expenses = Expenses::where('expensesCategory_id', '=', $category->id)->where('date', '>=', $monthstartdaystring)->get();
        $totalexpenses = 0;
        foreach ($expenses as $expense) {
            $totalexpenses += $expense->amount;
        }
        return $totalexpenses;
    }

    public static function calculateDifferenceBetweenDates($actmonth, $actyear, $prevmonth, $prevyear) {
        $actualFirstDateString = DateFunctions::firstDayOfMonthString($actmonth - 1, $actyear);
        $actualLastDateString = DateFunctions::lastDayOfMonthString($actmonth, $actyear);
        while (date('n', strtotime($actualFirstDateString)) == date('n', strtotime($actualLastDateString))) {
            $actualFirstDateString = date('Y-m-d', strtotime('-1 day', strtotime($actualFirstDateString)));
        }
        $actualFirstDateString = DateFunctions::dateToString($actualFirstDateString);
        $prevFirstDateString = DateFunctions::firstDayOfMonthString($prevmonth-1, $prevyear);
        $prevLastDateString = DateFunctions::lastDayOfMonthString($prevmonth, $prevyear);
        while (date('n', strtotime($prevFirstDateString)) == date('n', strtotime($prevLastDateString))) {
            $prevFirstDateString = date('Y-m-d', strtotime('-1 day', strtotime($prevFirstDateString)));
        }
        $prevFirstDateString = DateFunctions::dateToString($prevFirstDateString);
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
