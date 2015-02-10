<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Earnings\Earnings;
use Illuminate\Http\Request;

class EarningsController extends Controller {

    public function index() {
        $earnings = Earnings::all();
        return view('earnings.index')->with('earnings', $earnings);
    }

    public function create() {
        //
    }

    public function store() {
        //
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
