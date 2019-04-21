<?php

namespace Sitren\Http\Middleware;

use Closure;

class DBTrans
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request $request
  * @param  \Closure                 $next
  *
  * @return mixed
  * @throws \Exception
  */
  public function handle($request, Closure $next)
  {
    \DB::beginTransaction();
    try {
        $response = $next($request);
    } catch (\Exception $e) {
        \DB::rollBack();
        throw $e;
    }
    if ($response instanceof Response && $response->getStatusCode() > 399) {
        \DB::rollBack();
    } else {
        \DB::commit();
    }
    return $response;
  }
}
