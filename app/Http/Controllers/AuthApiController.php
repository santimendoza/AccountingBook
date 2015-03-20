<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthApiController extends Controller {

    public function apiLogin(Request $request, $email, $password) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $this->validate($request, $rules);
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            while (true) {
                $token = Crypt::encrypt(str_random(15));
                $user = User::where('authtoken', '=', $token)->get();
                if ($user->count() > 0) {
                    continue;
                } else {
                    break;
                }
            }
            Auth::user()->update(['authtoken' => $token]);
            return response()->json(['authtoken' => $token], 200);
        } else {
            return response('Login failed', 401);
        }
    }

    public function apiLogout(Request $request, $authtoken) {
        $user = User::where('authtoken', '=', $authtoken)->first();
        if ($user->count() > 0) {
            $user->update(['authtoken' => '']);
        }
        return response()->json('Logged out', 200);
    }

}
