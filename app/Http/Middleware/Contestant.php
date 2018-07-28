<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Contestant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->guest('home');
        }
        else{
            if (!(Auth::guard($guard)->user()->team_type == 'admin')) {
                return redirect()->route('error')->with('msg', 'Forbidden Area');
            }
        }

        return $next($request);
    }
}
