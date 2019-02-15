<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class MemberAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            if (Auth::user()->Roles == 2) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/login');
            }
        } else {
            Auth::logout();
            return redirect('/login');
        }
    }
}
