<?php

namespace Sitren\Http\Controllers\Pengurus;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class PengurusControl extends Controller
{
    public function index()
    {
      return view("pengurus.home",["title"=>"Dashboard Pengurus"]);
    }
}
