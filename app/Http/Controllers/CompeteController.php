<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CompeteController extends Controller
{
  public function __construct()
  {
    $this->middleware('checkRole:compete');
  }

  public function dashboard()
  {
    return view('compete.dashboard');
  }
}
