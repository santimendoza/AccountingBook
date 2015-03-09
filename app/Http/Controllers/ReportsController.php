<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\Earnings\Earnings;
use Auth;

class ReportsController extends Controller {

    public function earningsreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);

        $earnings = Earnings::whereRaw('user_id = ? and date <= ? and date >= ?', [
                    Auth::user()->id, $date2, $date1
                ])->orderBy('date')->get();
        $data = ['earnings' => $earnings, 'date1' => $request['date1'], 'date2' => $request['date2']];
        return view('earnings.index')->with($data);
    }

    public function expensesreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);

        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ?', [
                    Auth::user()->id, $date2, $date1
                ])->orderBy('date')->get();
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $data = ['expenses' => $expenses, 'date1' => $request['date1'],
            'date2' => $request['date2'], 'totalexpenses' => $totalexpenses];
        return view('expenses.index')->with($data);
    }

    public function expensesCategoryReport(Request $request, $id) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);

        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ? and expensesCategory_id = ?', [
                    Auth::user()->id, $date2, $date1, $id
                ])->orderBy('date')->get();
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $expensesCategory = ExpensesCategories::find($id);
        $data = ['expenses' => $expenses, 'date1' => $request['date1'],
            'date2' => $request['date2'], 'id' => $id, 'totalexpenses' => $totalexpenses, 'expensesCategory' => $expensesCategory];
        return view('expensesCategories.show')->with($data);
    }

    public function earningsCategoryReport(Request $request) {
        
    }

}
