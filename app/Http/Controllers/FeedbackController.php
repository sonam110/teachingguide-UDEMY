<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Feedback;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AddFeedback(Request $request)
    {
      if ($request->input("user_id"))
      {
          $ctime = Carbon::now()->toDateTimeString();
          $user_id = Auth::User()->id;
          $page = $request->input("page");
          $title = $request->input("title");
          $category = $request->input("category");
          $priority = $request->input("priority");
          $desc = $request->input("description");

          Feedback::create(
            array(
              'created_at' => $ctime,
              'user_id' => $user_id,
              'title' => $title,
              'description' => $desc,
              'page' => $page,
              'category_id' => $category,
              'priority_id' => $priority,
              'status_id' => 1,
              'comments' => '',
              'updated_at' => $ctime
            )
          );
      }
    }
}
