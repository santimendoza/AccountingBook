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
        $earnings = Earnings::all();
        return view('earnings.index')->with('earnings', $earnings);
    }

    public function create() {
        $categories = EarningsCategories::all();
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
