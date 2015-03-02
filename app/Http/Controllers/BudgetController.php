<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ExpensesCategories\ExpensesCategories;
use Illuminate\Http\Request;
use Auth;

class BudgetController extends Controller {

    public function index() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        $data = ['categories' => $categories];
        return view('budget.create')->with($data);
    }

    public function create() {
        return redirect('/budget');
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
                return redirect('/budget')
                                ->withErrors('El presupuesto asignado a esta categoría hace que se supere el presupuesto de su categoría superior', 'budgetError');
            } else {
                $expensesCategory->budget = $request['budget'];
                $expensesCategory->save();
                return redirect('/budget');
            }
        } else {
            $expensesCategory->budget = $request['budget'];
            $expensesCategory->save();
            return redirect('/budget');
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

}
