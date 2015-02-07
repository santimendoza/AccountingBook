<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoriesController extends Controller {

    public function index() {
        $categories = Category::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return redirect('newcategory')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
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
            if ($category->superior_cat != null) {
                array_push($superiorcategories[$category->superior_cat], $category);
            }
        }
        $categoriesarray[0] = $categoriessuperior;
        $categoriesarray[1] = $superiorcategories;
        return view('categories.indexcategory')->with('categories', $categoriesarray);
    }

    public function create() {
        $categories = Category::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        return view('categories.createcategory')->with('categories', $categories);
    }

    public function store(Request $request) {
        $request['user_id'] = Auth::user()->id;
        if (isset($request['superior_cat'])) {
            if ($request['superior_cat'] == -1)
                $request['superior_cat'] = null;
        }
        $rules = ['slug' => 'required', 'type' => 'required|integer', 'user_id' => 'integer'];
        $this->validate($request, $rules);
        Category::create($request->all());
        return redirect('categories');
    }

    public function show($id) {
        $category = Category::find($id);
        $categories = Category::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        $data = ['categories' => $categories, 'category' => $category];
        return view('categories.editcategory')->with($data);
    }

    public function edit($id) {
        //
    }

    public function update($id) {
        //
    }

    public function destroy($id) {
        //
    }

}
