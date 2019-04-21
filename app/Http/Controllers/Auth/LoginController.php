<?php

namespace Sitren\Http\Controllers\Auth;

use Sitren\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   protected function authenticated(Request $request, $user)
   {
     if (auth()->check()) {
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
   }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

}
