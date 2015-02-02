<?php

class CategoriesController extends \BaseController {

    public function index() {
        $categories = Category::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return Redirect::to('newcategory')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
        } else {
            $superiorcategories = array();
            $categoriessuperior = array();
            $totalcategories = 0;
            foreach ($categories as $category) {
                if ($category->superior_cat == null) {
                    $superiorcategories[$category->id] = array();
                    array_push($categoriessuperior, $category);
                    $totalcategories +=1;
                }
                if ($category->superior_cat != null) {
                    array_push($superiorcategories[$category->superior_cat], $category);
                }
            }
            $categoriesarray[0] = $categoriessuperior;
            $categoriesarray[1] = $superiorcategories;
            return View::make('categories.indexcategory')->with('categories', $categoriesarray);
        }
    }

    public function create() {
        $categories = Category::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        return View::make('categories.createcategory')->with('categories', $categories);
    }

    public function store() {
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
        if ($data['superior_cat'] == -1) {
            $data['superior_cat'] = null;
        }
        $rules = array(
            'slug' => 'required',
            'type' => 'required|integer',
            'user_id' => 'integer'
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('newcategory')->withErrors($messages);
        } else {
            Category::create($data);
            return Redirect::to('categories');
        }
    }

    public function show($id) {
        $category = Category::find($id);
        $categories = Category::whereRaw('user_id  = ?', array(Auth::user()->id))->whereNull('superior_cat')->get();
        $data = array(
            'categories'    => $categories,
            'category'      => $category,
        );
        return View::make('categories.editcategory')->with($data);
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
