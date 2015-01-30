<?php

class SessionsController extends \BaseController {

    public function create() {
        if (Auth::check()) {
            return Redirect::to('user');
        } else {
            return View::make('login');
        }
    }

    public function store() {
        $data = Input::all();
        $username = $data['username'];
        $password = $data['password'];
        if (Auth::attempt(array('username' => $username, 'password' => $password))) {
            return Redirect::intended('user');
        } else {
            return Redirect::to('login')->withErrors('Login failed!');
        }
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::to('login');
        }
    }

}
