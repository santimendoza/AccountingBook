<?php

class UserController extends \BaseController {

    public function index() {
        return View::make('user.profile');
    }

    public function create() {
        return View::make('createuser');
    }

    public function store() {
        $data = Input::all();
        $rules = array(
            'name' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required',
            'currency' => 'required|min:1|max:3'
        );
        $validator = Validator::make($data, $rules);
        $data['confirmation_code'] = str_random(32);
        while (User::where('status', '=', 0)->whereRaw('confirmation_code = ?', array('confirmation_code', $data['confirmation_code']))->count() > 0) {
            $data['confirmation_code'] = str_random(32);
        }
        $data['password'] = Hash::make($data['password']);
        if ($validator->fails()) {
            return Redirect::to('signup')->withErrors($validator, 'signup');
        } else {
            Mail::send('mail.confirmemail', array('user' => $data), function($message) {
                $data = Input::only('name', 'email');
                $message->to($data['email'], $data['name'])->subject('Bienvenido!');
            });
            User::create($data);
            $message = array(
                'message' => 'Para iniciar sesión, ve a tu correo y confirma tu cuenta.',
            );
            return Redirect::to('login')->withErrors($message, 'registroexitoso');
        }
    }

    public function show($username) {
        $user = User::where('username', '=', $username)->first();
        return View::make('user.userprofile')->with('user', $user);
    }

    public function edit($id) {
        return View::make('user.editprofile');
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
        if(Auth::user()->email != $data['email']){
            
        }else{
            
        }
    }

    public function destroy($id) {
        //
    }

    public function confirm($confirmationcode) {
        $user = User::whereConfirmationCode($confirmationcode)->first();
        //$user = User::where('confirmation_code', '=', $confirmationcode)->first();
        if (!$user) {
            return Redirect::to('login')->withErrors('El codigo de confirmación no es valido.', 'confirmation');
        } else {
            $user->status = 1;
            $user->confirmation_code = NULL;
            $user->save();
            return Redirect::to('login')->withErrors('Tu cuenta ha sido confirmada.', 'confirmation');
        }
    }

}
