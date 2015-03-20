<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $authtoken = $request['token'];
        if ($authtoken != null) {
            $user = User::where('authtoken', '=', $authtoken)->first();
            if ($user->count() > 0) {
                return $next($request);
            }
        }
        throw new \Exception("Token invalido");
    }

}
