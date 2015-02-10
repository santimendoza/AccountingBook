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
        $expenses = Expenses::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($expenses->count() < 1) {
            return redirect('/expenses/create')->withErrors('Parece que no tienes ningún gasto registrado. Agrega uno.', 'expensesError');
        }
        return view('expenses.index')->with('expenses', $expenses);
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
        $request['date'] = str_replace('-', '', $request['date']);
        $request['user_id'] = Auth::user()->id;
        $this->validate($request, $rules);
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
        $expense = Expenses::find($id);
        $expense->amount = $request['amount'];
        $expense->description = $request['description'];
        $expense->expensesCategory_id = $request['expensesCategory_id'];
        $expense->date = str_replace('-', '', $request['date']);
        $expense->save();
        return redirect('expenses');
    }

    public function destroy(Request $request, $id) {
        $expense = Expenses::find($id);
        $expense->delete();
        return redirect('expenses');
    }

}
