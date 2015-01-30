<?php

class UserController extends \BaseController {

    public function index() {
        Auth::user();
        return View::make('user.profile');
    }

    public function create() {
        //
    }

    public function store() {
        //
    }

    public function show($username) {
        $user = User::where('username', '=', $username)->first();
        return View::make('user.userprofile')->with('user', $user);
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
