<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses\Expenses;
use App\Models\Earnings\Earnings;
use Auth;

class ReportsController extends Controller {

    public function earningsreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);
        
        $earnings = Earnings::whereRaw('user_id = ? and date <= ? and date >= ?', [
            Auth::user()->id, $date2, $date1
        ])->orderBy('date')->get();
        $data = ['earnings' => $earnings,'date1' => $request['date1'] , 'date2' => $request['date2']];
        return view('earnings.index')->with($data);
    }

    public function expensesreport(Request $request) {
        $date1 = str_replace('-', '', $request['date1']);
        $date2 = str_replace('-', '', $request['date2']);
        
        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ?', [
            Auth::user()->id, $date2, $date1
        ])->orderBy('date')->get();  
        $data = ['expenses' => $expenses,'date1' => $request['date1'] , 'date2' => $request['date2']];
        return view('expenses.index')->with($data);
    }

}
