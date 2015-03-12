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
use App\Models\ExpensesCategories\ExpensesCategoriesFunctions;
use Auth;

class DashboardController extends Controller {

    public function dashboard() {
        $expenses = DashboardController::expensesDashboard();
        $earnings = DashboardController::earningsDashboard();
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

    public function expensesDashboard() {
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

    public function earningsDashboard() {
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
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)
                        ->whereNull('superior_cat')->get();
        if (count($categories) < 1) {
            return 0;
        }
        foreach ($categories as $category) {
            $category->amount = ExpensesCategoriesFunctions::calculateExpensesCategoryValue($category);
        }
        return $categories;
    }

}
