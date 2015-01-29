<?php

class SessionsController extends \BaseController {

    public function index() {
    }

    public function create() {
        return View::make('login');
    }

    public function store() {
        $data = Input::all();
        $username = $data['username'];
        $password = $data['password'];
        if (Auth::attempt(array('username' => $username, 'password' => $password))) {
            return Redirect::intended('user');
        } else {
            return Redirect::to('login')->with('error', 'Login failed!');
        }
    }

    public function show($id) {
    }

    public function edit($id) {
    }

    public function update($id) {
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::to('login');
        }
    }

}
