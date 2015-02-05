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

    public function create() {
        return view('createuser');
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'currency' => 'required|min:1|max:3'
        ];
        $this->validate($request, $rules);
        $request['confirmation_code'] = str_random(32);
        while (User::where('status', '=', 0)->whereRaw('confirmation_code = ?', array('confirmation_code', $request['confirmation_code']))->count() > 0) {
            $request['confirmation_code'] = str_random(32);
        }
        $request['password'] = Hash::make($request['password']);
        Mail::send('mail.confirmemail', array('user' => $request->all()), function($message) {
            $request = new Request;
            $request->input('name', 'email');
            $message->to($request['email'], $request['name'])->subject('Bienvenido!');
        });
        User::create($request->all());
        $message = ['message' => 'Para iniciar sesión, ve a tu correo y confirma tu cuenta.'];
        return redirect('login')->withErrors($message, 'registroexitoso');
    }

    public function show($username) {
        $user = User::where('username', '=', $username)->first();
        return view('user.userprofile')->with('user', $user);
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
        $validator = Validator::make($data, $rules);
        if (Auth::user()->email != $data['email']) {
            
        } else {
            
        }
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
