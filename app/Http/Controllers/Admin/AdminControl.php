<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class AdminControl extends Controller
{
  public function index()
  {
    return view("admin.home",["title"=>"Dashboard Admin"]);
  }
  
}
