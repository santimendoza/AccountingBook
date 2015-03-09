<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\User;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\DateFunctions;
use Illuminate\Http\Request;
use Auth;

class ExpensesController extends Controller {

    public function index() {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartday = $dates[0];
        $monthendday = $dates[1];
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $monthenddaystring = DateFunctions::dateToString($dates[1]);
        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ?', [
                    Auth::user()->id, $monthenddaystring, $monthstartdaystring
                ])->orderBy('date')->get();
        if ($expenses->count() < 1) {
            return redirect('/expenses/create')->withErrors('Parece que no tienes ningún gasto registrado este mes. Agrega uno.', 'expensesError');
        }
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $data = ['expenses' => $expenses, 'date1' => $monthstartday,
            'date2' => $monthendday, 'totalexpenses' => $totalexpenses];
        return view('expenses.index')->with($data);
    }

    public function create() {
        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($categories->count() < 1) {
            return redirect('/categories/expenses/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.', 'expensesCategoriesError');
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
        $user = User::find(Auth::user()->id);
        $user->balance = $user->balance - $request['amount'];
        $user->save();
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
        if ($expense->count() >= 1) {
            $user = User::find(Auth::user()->id);
            $user->balance = $user->balance + $expense->amount;
            $expense->delete();
            $user->save();
        }
        return redirect('expenses');
    }

}
