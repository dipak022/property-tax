<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if( Auth::guard($guard)->check() && Auth::user()->role == 1){
                return redirect()->route('superadmin.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == 2){
                return redirect()->route('admin.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == 3){
                return redirect()->route('user.dashboard');
            }
            elseif( Auth::guard($guard)->check() && Auth::user()->role == 4){
                return redirect()->route('technician.dashboard');
            }
        }

        return $next($request);
    }
}
