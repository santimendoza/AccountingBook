<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Earnings\Earnings;
use App\Models\Expenses\Expenses;
use App\Models\User;
use App\Models\EarningsCategories\EarningsCategories;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller {

    public function expensesCategoriesPercent() {
        $expenses = DashboardController::expenses();
        $earnings = DashboardController::earnings();
        $data = ['expenses' => $expenses, 'earnings' => $earnings];
        return view('user.profile')->with($data);
    }

    public function expenses() {
        $monthstartday = date('Y-m-d', mktime(1, 1, 1, date('n'), 1, date('Y')));
        $gastostotales = 0;
        $gastoscategoria = [];
        $expensescategories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        foreach ($expensescategories as $categories) {
            $gastos = 0;
            $expenses = Expenses::where('expensesCategory_id', '=', $categories->id)
                    ->where('date', '>=', $monthstartday)
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
        $monthstartday = date('Y-m-d', mktime(1, 1, 1, date('n'), 1, date('Y')));
        $gastostotales = 0;
        $gastoscategoria = [];
        $earningscategories = EarningsCategories::where('user_id', '=', Auth::user()->id)->get();
        foreach ($earningscategories as $categories) {
            $ingresos = 0;
            $earnings = Earnings::where('earningsCategory_id', '=', $categories->id)
                    ->where('date', '>=', $monthstartday)
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

}
