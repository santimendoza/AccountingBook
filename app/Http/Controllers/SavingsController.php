<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SavingsController extends Controller {

    public function index() {
        //
    }

    public function create() {
        return view('savings.create');
    }

    public function store(Request $request) {
        dd($request);
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
