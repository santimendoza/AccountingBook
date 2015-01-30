<?php

class CategoriesController extends \BaseController {

    public function index() {
        $categories = Category::where('user_id', '=', Auth::user()->id);
        $superiorcategories = array();
        $categoriessuperior = array();
        $totalcategories = 0;
        foreach ($categories as $category) {
            dd($category);
            if ($category->superior_cat == null) {
                $superiorcategories[$category->id] = array();
                array_push($categoriessuperior, $category);
                $totalcategories +=1;
            }
            if($category->superior_cat != null){
                array_push($superiorcategories[$category->superior_cat],$category);
            }
        }
        dd($categories);
        $categoriesarray[0] = $categoriessuperior;
        $categoriesarray[1] = $superiorcategories;
        return View::make('categories.indexcategory')->with('categories', $categoriesarray);
    }

    public function create() {
        $categories = Category::where('users_id', '=', Auth::user()->id);
        return View::make('categories.createcategory')->with('categories', $categories);
    }

    public function store() {
        $data = Input::all();
        $data['user_id'] = Auth::user()->id;
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
            return Redirect::to('user');
        }
    }

    public function show($id) {
        //
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
