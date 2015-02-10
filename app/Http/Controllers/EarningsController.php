<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Earnings\Earnings;
use Illuminate\Http\Request;
use App\Models\EarningsCategories\EarningsCategories;
use Auth;

class EarningsController extends Controller {

    public function index() {
        $earnings = Earnings::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if($earnings->count() <1){
            return redirect('/earnings/create')->withErrors('Parace que aún no tienes ningún ingreso registrado. Agrega uno.', 'earningsError');
        }
        return view('earnings.index')->with('earnings', $earnings);
    }

    public function create() {
        $categories = EarningsCategories::whereRaw('user_id = ?', [Auth::user()->id])->get();
        if( $categories->count() < 1){
            return redirect('/categories/earnings/create')->withErrors('Parece que aún no tienes categorías. Crea una en el siguiente formulario.');
        }
        return view('earnings.create')->with('categories', $categories);
    }

    public function store(Request $request) {
        $rules =[
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'earningsCategory_id' => 'required'
        ];
        $request['date'] = str_replace('-', '', $request['date']);
        $request['user_id'] = Auth::user()->id;
        $this->validate($request, $rules);
        Earnings::create($request->all());
        return redirect('earnings');
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
