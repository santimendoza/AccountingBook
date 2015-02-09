<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EarningsCategories\EarningsCategories;
use Auth;

class EarningsCategoriesController extends Controller {

    public function index() {
        $categories = EarningsCategories::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return redirect('/categories/earnings/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
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
        return view('earningsCategories.indexcategory')->with('categories', $categoriesarray);
    }

    public function create() {
        $categories = EarningsCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        return view('earningsCategories.createcategory')->with('categories', $categories);
    }

    public function store(Request $request) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1)
                $request['superior_cat'] = null;
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer', 'superior_cat'];
        $this->validate($request, $rules);
        EarningsCategories::create($request->all());
        return redirect('categories/earnings');
    }

    public function show($id) {
        return redirect('/categories/earnings/' . $id . '/edit');
    }

    public function edit($id) {
        $category = EarningsCategories::find($id);

        if (EarningsCategories::whereRaw('superior_cat = ?', array($category->id))->count() < 1) {
            $categories = EarningsCategories::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
            $data = ['categories' => $categories, 'category' => $category];
        } else {
            $data = ['categories' => $categories = null, 'category' => $category];
        }

        return view('earningsCategories.editcategory')->with($data);
    }

    public function update(Request $request, $id) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1)
                $request['superior_cat'] = null;
        }
        $rules = ['slug' => 'required', 'user_id' => 'integer', 'superior_cat'];
        $this->validate($request, $rules);
        $category = EarningsCategories::find($id);
        $category->superior_cat = $request['superior_cat'];
        $category->slug = $request['slug'];
        $category->save();
        return redirect('categories/earnings');
    }

    public function destroy($id) {
        //
    }

}
