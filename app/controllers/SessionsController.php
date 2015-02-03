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
        $user = User::where('username', '=', $username)->first();
        if ($user != null) {
            if ($user->status == 0) {
                return Redirect::intended('login')->withErrors('Confirma tu correo antes de iniciar sesión.', 'confirmemail');
            }
        }
        if (Auth::attempt(array('username' => $username, 'password' => $password))) {
            return Redirect::intended('user');
        } else {
            return Redirect::to('login')->withErrors('Login failed!', 'login');
        }
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::to('login');
        }
    }

}
