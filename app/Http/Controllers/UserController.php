<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller {

    public function index() {
        return view('user.profile');
    }

    public function show($username) {
        $user = User::where('username', '=', $username)->first();
        $data = ['user' => $user];
        return view('user.userprofile')->with($data);
    }

    public function edit($id) {
        return view('user.editprofile');
    }

    public function update($id) {
        $data = Input::only('name', 'lastname', 'username', 'email', 'password');
        $rules = array(
          'name' => 'required',
          'lastname' => 'required',
          'username' => 'required|unique:users',
          'email' => 'required|unique:users',
          'password' => 'required',
          );
    }

    public function destroy($id) {
        //
    }

    public function confirm($confirmationcode) {
        $user = User::whereConfirmationCode($confirmationcode)->first();
        //$user = User::where('confirmation_code', '=', $confirmationcode)->first();
        if (!$user) {
            return redirect('login')->withErrors('El codigo de confirmación no es valido.', 'confirmation');
        } else {
            $user->status = 1;
            $user->confirmation_code = NULL;
            $user->save();
            return redirect('login')->withErrors('Tu cuenta ha sido confirmada.', 'confirmation');
        }
    }

}
