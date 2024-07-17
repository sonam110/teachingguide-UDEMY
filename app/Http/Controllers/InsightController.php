<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class InsightController extends Controller
{
  public function __construct()
  {
    $this->middleware('checkRole:insight');
  }

  public function dashboard()
  {
    return view('insight.insightDashboard');
  }

  public function searchCourse()
  {
      return view('insight.insightSearchCourse');
  }

  public function searchAuthor()
  {
      return view('insight.insightSearchAuthor');
  }

  public function searchTopic()
  {
      return view('insight.insightSearchTopic');
  }
}
