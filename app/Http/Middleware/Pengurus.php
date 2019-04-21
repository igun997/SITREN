<?php

namespace Sitren\Http\Middleware;

use Closure;

class Pengurus
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
      if (auth()->check() && auth()->user()->level == "pengurus") {
        return $next($request);
      }
      return redirect("login")->with("error","Akses Terbatas Silahkan Login");
    }
}
