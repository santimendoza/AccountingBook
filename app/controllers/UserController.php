<?php

class UserController extends \BaseController {

    public function index() {
        Auth::user();
        return View::make('user.userprofile');
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
