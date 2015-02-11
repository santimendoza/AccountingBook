<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Expenses\Expenses;
use App\Models\ExpensesCategories\ExpensesCategories;
use Illuminate\Http\Request;
use Auth;

class ExpensesController extends Controller {

    public function index() {
        $m = date('n');
        $monthstartday = date('Y-m-d', mktime(1, 1, 1, $m, 1, date('Y')));
        $monthendday = date('Y-m-d', mktime(1, 1, 1, $m + 1, 0, date('Y')));
        $monthstartdaystring = str_replace('-', '', $monthstartday);
        $monthenddaystring = str_replace('-', '', $monthendday);

        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ?', [
                    Auth::user()->id, $monthenddaystring, $monthstartdaystring
                ])->get();
        if ($expenses->count() < 1) {
            return redirect('/expenses/create')->withErrors('Parece que no tienes ningún gasto registrado este mes. Agrega uno.', 'expensesError');
        }
        $data = ['expenses' => $expenses, 'date1' => $monthstartday, 'date2' => $monthendday];
        return view('expenses.index')->with($data);
    }

    public function create() {
        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($categories->count() < 1) {
            return redirect('/categories/expenses/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
        }
        return view('expenses.create')->with('categories', $categories);
    }

    public function store(Request $request) {
        $rules = [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'expensesCategory_id' => 'required'
        ];
        $this->validate($request, $rules);
        $request['date'] = str_replace('-', '', $request['date']);
        $request['user_id'] = Auth::user()->id;
        Expenses::create($request->all());
        return redirect('/expenses');
    }

    public function show($id) {
        return redirect('/expenses/' . $id . '/edit');
    }

    public function edit($id) {
        $expense = Expenses::find($id);
        $date = strtotime($expense->date);
        $expense->date = date('Y-m-d', $date);
        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        $data = ['expense' => $expense, 'categories' => $categories];
        return view('expenses.edit')->with($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'expensesCategory_id' => 'required'
        ];
        $this->validate($request, $rules);
        $expense = Expenses::find($id);
        $expense->amount = $request['amount'];
        $expense->description = $request['description'];
        $expense->expensesCategory_id = $request['expensesCategory_id'];
        $expense->date = str_replace('-', '', $request['date']);
        $expense->save();
        return redirect('expenses');
    }

    public function destroy($id) {
        $expense = Expenses::find($id);
        dd($expense->count());
        if ($expense->count() >= 1) {
            $expense->delete();
        }
        return redirect('expenses');
    }

}
