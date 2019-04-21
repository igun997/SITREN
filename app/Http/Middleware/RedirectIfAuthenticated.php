<?php

namespace Sitren\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (auth()->user()->level == "admin") {
              return redirect('/admin');
            }elseif (auth()->user()->level == "tu") {
              return redirect('/tu');
            }elseif (auth()->user()->level == "pengurus") {
              return redirect('/pengurus');
            }elseif (auth()->user()->level == "santri") {
              return redirect('/santri');
            }elseif (auth()->user()->level == "bmt") {
              return redirect('/bmt');
            }else {
              return $next($request);
            }
        }

        return $next($request);
    }
}
