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
        if ($validator->fails()) {
            return Redirect::to('signup')->withErrors($validator, 'signup');
        } else {
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            $message = array(
                'message' => 'Registro exitoso!',
            );
            return Redirect::to('login')->withErrors($message, 'registroexitoso');
        }
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
