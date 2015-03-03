<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\ExpensesCategories\ExpensesCategoriesFunctions;
use App\Models\Savings\Savings;
use Illuminate\Http\Request;
use Auth;

class BudgetController extends Controller {

    public function index() {
        return redirect('/budget/create');
    }

    public function create() {
        $categories = ExpensesCategoriesFunctions::getCategoriesAndSubcategories();
        if(count($categories) <= 1){
            return redirect('/categories/expenses')->withErrors('Parace que aún no tienes categorías de gasto. Crea una a continuación', 'expensesCategoriesError');
        }
        $totalBudget = ExpensesCategoriesFunctions::getTotalBudget();
        $savings = Savings::where('user_id', '=', Auth::user()->id)->get();
        $data = ['categories' => $categories, 'totalBudget' => $totalBudget, 'savings' => $savings];
        return view('budget.create')->with($data);
        
    }

    public function store(Request $request) {
        $rules = [
            'id' => 'required|numeric',
            'budget' => 'required|numeric'
        ];
        $this->validate($request, $rules);
        $expensesCategory = ExpensesCategories::find($request['id']);
        if ($expensesCategory->superior_cat != null) {
            $superior_cat = ExpensesCategories::find($expensesCategory->superior_cat);
            $subcategories = ExpensesCategories::where('superior_cat', '=', $expensesCategory->superior_cat)->get();
            $totalcategory = 0;
            foreach ($subcategories as $subcategory) {
                if ($subcategory->id != $expensesCategory->id) {
                    $totalcategory += $subcategory->budget;
                }
            }
            $totalcategory += $request['budget'];
            if ($totalcategory > $superior_cat->budget) {
                return redirect('/budget/create')
                                ->withErrors('El presupuesto asignado a esta categoría hace que se supere el presupuesto de su categoría superior', 'budgetError');
            } else {
                $expensesCategory->budget = $request['budget'];
                $expensesCategory->save();
                return redirect('/budget/create');
            }
        } else {
            $expensesCategory->budget = $request['budget'];
            $expensesCategory->save();
            return redirect('/budget/create');
        }
    }

    public function show($id) {
        return redirect('/budget/create');
    }

    public function edit($id) {
        return redirect('/budget/create');
    }

    public function update($id) {
//
    }

    public function destroy($id) {
        return redirect('/budget/create');
    }

    public function storeSavingsBudget(Request $request) {
        $rules = [
            'id' => 'required|numeric',
            'budget' => 'required|numeric'
        ];
        $this->validate($request, $rules);
        $saving = Savings::find($request['id']);
        if ($saving != null) {
            $saving->budget = $request['budget'];
            $saving->save();
            return redirect('/budget/create');
        } else {
            return redirect('/budget/create')->withErrors('El ahorro que ha intentado presupuestar no existe.', 'budgetError');
        }
    }

}
