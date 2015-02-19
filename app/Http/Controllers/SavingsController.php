<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Savings\Savings;
use Auth;

class SavingsController extends Controller {

    public function index() {
        $savings = Savings::all();
        return view('savings.index')->with('savings', $savings);
    }

    public function create() {
        return view('savings.create');
    }

    public function store(Request $request) {
        $rules = [
            'amount' => 'required|numeric',
            'description' => 'required',
            'title' => 'required',
        ];
        $this->validate($request, $rules);
        $request['user_id'] = Auth::user()->id;
        Savings::create($request->all());
        return redirect('savings');
    }

    public function show($id) {
        return redirect('/savings/'.$id.'/edit');
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
