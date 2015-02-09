<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensesCategories\ExpensesCategories;
use Auth;

class ExpensesCategoriesController extends Controller {

    public function index() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return redirect('/categories/expenses/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
        }
        $superiorcategories = [];
        $categoriessuperior = [];
        $totalcategories = 0;
        foreach ($categories as $category) {
            if ($category->superior_cat == null) {
                $superiorcategories[$category->id] = [];
                array_push($categoriessuperior, $category);
                $totalcategories +=1;
            }
        }
        foreach ($categories as $category) {
            if ($category->superior_cat != null) {
                array_push($superiorcategories[$category->superior_cat], $category);
            }
        }
        $categoriesarray[0] = $categoriessuperior;
        $categoriesarray[1] = $superiorcategories;
        return view('expensesCategories.indexcategory')->with('categories', $categoriesarray);
    }

    public function create() {
        $categories = ExpensesCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        return view('expensesCategories.createcategory')->with('categories', $categories);
    }

    public function store(Request $request) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1)
                $request['superior_cat'] = null;
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer', 'superior_cat'];
        $this->validate($request, $rules);
        ExpensesCategories::create($request->all());
        return redirect('categories/expenses');
    }

    public function show($id) {
        return redirect('/categories/expenses/' . $id . '/edit');
    }

    public function edit($id) {
        $category = ExpensesCategories::find($id);
        
        if (ExpensesCategories::whereRaw('superior_cat = ?', array($category->id))->count() < 1) {
            $categories = ExpensesCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
            $data = ['categories' => $categories, 'category' => $category];
        }else{
            $data = ['categories' => $categories = null, 'category' => $category];
        }
        
        return view('expensesCategories.editcategory')->with($data);
    }

    public function update(Request $request, $id) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1)
                $request['superior_cat'] = null;
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer', 'superior_cat'];
        $this->validate($request, $rules);
        $category = ExpensesCategories::find($id);
        $category->superior_cat = $request['superior_cat'];
        $category->slug = $request['slug'];
        $category->save();
        return redirect('categories/expenses');
    }

    public function destroy($id) {
        //
    }

}
