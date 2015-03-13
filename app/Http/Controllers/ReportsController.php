<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\ExpensesCategories\ExpensesCategoriesFunctions;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\Earnings\Earnings;
use Auth;

class ReportsController extends Controller {

    public function earningsreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);

        $earnings = Earnings::where('user_id', '=', Auth::user()->id)
                        ->where('date', '<=', $date2)
                        ->where('date', '>=', $date1)
                        ->orderBy('date')->get();
        $data = ['earnings' => $earnings, 'date1' => $request['date1'], 'date2' => $request['date2']];
        return view('earnings.index')->with($data);
    }

    public function expensesreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);

        $expenses = Expenses::where('user_id', '=', Auth::user()->id)
                        ->where('date', '<=', $date2)
                        ->where('date', '>=', $date1)
                        ->orderBy('date')->get();
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $data = ['expenses' => $expenses, 'date1' => $request['date1'],
            'date2' => $request['date2'], 'totalexpenses' => $totalexpenses];
        return view('expenses.index')->with($data);
    }

    public function expensesCategoryReport(Request $request, $id) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);
        $expensesCategory = ExpensesCategories::find($id);
        $expenses = ExpensesCategoriesFunctions::getExpensesCategoriesFromDates($expensesCategory, $date1, $date2);
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $data = ['expenses' => $expenses, 'date1' => $request['date1'],
            'date2' => $request['date2'], 'id' => $id, 'totalexpenses' => $totalexpenses, 'expensesCategory' => $expensesCategory];
        return view('expensesCategories.show')->with($data);
    }

    public function earningsCategoryReport(Request $request) {
        
    }

}
