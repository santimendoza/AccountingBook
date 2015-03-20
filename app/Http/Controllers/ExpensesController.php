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

    public function index(Request $request) {
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
        if ($request->route()->getPrefix() == 'api/') {
            return response()->json($data, 200);
        }
        return view('expenses.index')->with($data);
    }

    public function create(Request $request) {
        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if ($categories->count() < 1) {
            return redirect('/categories/expenses/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.', 'expensesCategoriesError');
        }
        if ($request->route()->getPrefix() == 'api/') {
            return response()->json($categories, 200);
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
        if ($user->save()) {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['Gasto creado'], 201);
            }
            return redirect('/expenses');
        } else {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['Parace que hubo un error, intentalo de nuevo.'], 400);
            }
            return redirect()->back()->withInput()->withErrors('Parece que hubo un error, intentalo de nuevo.', 'expensesError');
        }
    }

    public function show(Request $request, $id) {
        if ($request->route()->getPrefix() == 'api/') {
            return redirect('/api/expenses/' . $id . '/edit');
        }
        return redirect('/expenses/' . $id . '/edit');
    }

    public function edit(Request $request, $id) {
        $expense = Expenses::find($id);
        $date = strtotime($expense->date);

        $expense->date = date('Y-m-d', $date);

        $categories = ExpensesCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        $data = ['expense' => $expense, 'categories' => $categories];
        if ($request->route()->getPrefix() == 'api/') {
            return response()->json($data, 200);
        }

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
        $difference = $expense->amount - $request['amount'];
        $expense->amount = $request['amount'];
        $expense->description = $request['description'];
        $expense->expensesCategory_id = $request['expensesCategory_id'];
        $expense->date = str_replace('-', '', $request['date']);
        $user = User::find(Auth::user()->id);
        $user->balance += $difference;
        if ($user->save() && $expense->save()) {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['Actualizado correctamente'], 200);
            }
            return redirect('expenses');
        } else {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['Ha ocurrido un error. Intentalo de nuevo.'], 401);
            }
            return redirect()->back()->withInput()->withErrors('Parece que hubo un error, intentalo de nuevo.', 'expensesError');
        }
    }

    public function destroy(Request $request, $id) {
        $expense = Expenses::find($id);
        if ($expense->count() < 1) {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['No existe el gasto que quieres eliminar'], 400);
            }
            return redirect('expenses')->withErrors('No existe el gasto que quieres eliminar', 'expensesError');
        }
        $user = User::find(Auth::user()->id);
        $user->balance = $user->balance + $expense->amount;
        if ($user->save() && $expense->delete()) {
            if ($request->route()->getPrefix() == 'api/') {
                return response()->json(['Eliminado correctamente'], 200);
            }
            return redirect('expenses');
        }
        return redirect('expenses');
    }

}
