<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\Expenses\Expenses;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\ExpensesCategories\ExpensesCategoriesFunctions;
use App\Models\DateFunctions;
use Auth;

class ExpensesCategoriesController extends Controller {

    public function index() {
        $categoriesarray = ExpensesCategoriesFunctions::getCategoriesAndSubcategories();
        if (count($categoriesarray) > 1) {
            return view('expensesCategories.indexcategory')->with('categories', $categoriesarray);
        } else {
            return redirect('/categories/expenses/create')->withErrors('No tienes ninguna categoría creada. Crea una a continuación', 'expensesCategoriesError');
        }
    }

    public function create() {
        $categories = ExpensesCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        return view('expensesCategories.createcategory')->with('categories', $categories);
    }

    public function store(Request $request) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1) {
                $request['superior_cat'] = null;
            }
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer', 'superior_cat'];
        $this->validate($request, $rules);
        ExpensesCategories::create($request->all());
        return redirect('categories/expenses');
    }

    public function show($id) {
        $month = date('n');
        $year = date('Y');
        $monthstartday = date('Y-m-d', mktime(1, 1, 1, $month - 1, Auth::user()->courtdate, $year));
        $monthendday = date('Y-m-d', mktime(1, 1, 1, $month, Auth::user()->courtdate, $year));
        while (date('n', strtotime($monthstartday)) == date('n', strtotime($monthendday))) {
            $monthstartday = date('Y-m-d', strtotime('-1 day', strtotime($monthstartday)));
        }
        $monthstartdaystring = DateFunctions::dateToString($monthstartday);
        $monthenddaystring = DateFunctions::dateToString($monthendday);
        $expenses = Expenses::whereRaw('user_id = ? and date <= ? and date >= ? and expensesCategory_id = ?', [
                    Auth::user()->id, $monthenddaystring, $monthstartdaystring, $id
                ])->orderBy('date')->get();
        $expensesCategory = ExpensesCategories::find($id);
        $totalexpenses = ExpensesFunctions::calculateTotalExpenses($expenses);
        $data = ['expenses' => $expenses, 'date1' => $monthstartday, 'date2' => $monthendday,
            'expensesCategory' => $expensesCategory, 'totalexpenses' => $totalexpenses];
        return view('expensesCategories.show')->with($data);
    }

    public function edit($id) {
        $category = ExpensesCategories::find($id);
        if (ExpensesCategories::whereRaw('superior_cat = ?', array($category->id))->count() < 1) {
            $hasSubcategories = false;
        } else {
            $hasSubcategories = true;
        }
        $categories = ExpensesCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        $data = ['categories' => $categories, 'category' => $category, 'hasSubcategories' => $hasSubcategories];
        return view('expensesCategories.editcategory')->with($data);
    }

    public function update(Request $request, $id) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1) {
                $request['superior_cat'] = null;
            }
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer'];
        $this->validate($request, $rules);
        $category = ExpensesCategories::find($id);
        $category->superior_cat = $request['superior_cat'];
        $category->slug = $request['slug'];
        $category->save();
        return redirect('categories/expenses');
    }

    public function destroy($id) {
        $category = ExpensesCategories::find($id);
        $category->delete();
        return redirect('/categories/expenses');
    }

}
