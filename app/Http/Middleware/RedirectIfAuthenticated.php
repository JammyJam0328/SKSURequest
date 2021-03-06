<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
               if(auth()->user()->role=="requestor"){
                return redirect()->route('requestor-dashboard');
               }

               if(auth()->user()->role=="registrar"){
                return redirect()->route('registrar-dashboard');
                }

                if(auth()->user()->role=="admin"){
                    return redirect()->route('admin-dashboard');
                }
            }
        }

        return $next($request);
    }
}
