<?php

namespace Sitren\Http\Middleware;

use Closure;

class Admin
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
       if (auth()->check() && auth()->user()->level == "admin") {
         return $next($request);
       }
       return redirect("login")->with("msg","Akses Terbatas Silahkan Login");
    }
}
