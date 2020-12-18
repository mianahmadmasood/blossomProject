<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthEmployee {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::check() && !empty(Auth::user()->role_id) && Auth::user()->role_id == 3) {
            return $next($request);
        }
        return redirect()->route('login')->with('error_message', 'it seems that you are not logged into the system.');
    }

}
