<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use View;

class SessionsController extends Controller {

    public function create() {
        if (Auth::check()) {
            return redirect('user');
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
            return redirect('login')->withErrors('Login failed!', 'login');
        }
    }

    public function destroy() {
        if (Auth::check()) {
            Auth::logout();
            return redirect('login');
        }
    }

}
