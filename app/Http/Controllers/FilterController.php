<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Topic;
use App\Filter_user;
use Carbon\Carbon;
use timgws\QueryBuilderParser;
use Auth;

class FilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $user_id = Auth::User()->id;
      $match = ['user_id' => $user_id];
      $filter = Filter_user::where($match)->get();

      return view('filter.index', compact('filter'));
    }

    public function create()
    {
        return view('filter.create');
    }

    public function edit($id)
    {
        $filter = Filter_user::find($id);
        return view('filter.edit', compact('filter'));
    }

    public function createnew(Request $request) {
        //dd($request);

        $ctime = Carbon::now()->toDateTimeString();

        $user_id = Auth::User()->id;
        //$user_id = $request->input("user_id");
        $filter_type = $request->input('filter_type');
        $filter_name = $request->input('filter_name');
        $filter_sql_where = $request->input('sql_where');
        $ruleset = $request->input('ruleset');

        Filter_user::create(array('user_id' => $user_id, 'type' => $filter_type, 'name' => $filter_name, 'definition' => $ruleset, 'sql_where' => $filter_sql_where, 'updated_at' => $ctime, 'created_at' => $ctime));

        return redirect()->intended('filter');

    }

    public function update(Request $request, $id) {

        $ctime = Carbon::now()->toDateTimeString();
        $filter = Filter_user::find($id);
        $filter->name = $request->input('filter_name');
        $filter->type = $request->input('filter_type');
        $filter->definition = $request->input('ruleset');
        $filter->sql_where = $request->input('sql_where');
        $filter->updated_at = $ctime;
        $filter->save();
        return redirect()->intended('filter');

    }

    public function destroy($id) {
        $filter = Filter_user::find($id);
        $filter->delete();

        echo json_encode([
            "success" => true,
            "message" => "Filter sucessfully deleted."
        ]);
    }

    public function getFilter(Request $request) {
      $id = $request->id;

      if (empty($id)) {
          return \Response::json([]);
      }
      $filter = Filter_user::find($id);
      $formatted = [
        'id' => $id,
        'type' => $filter->type,
        'name' => $filter->name,
        'definition' => $filter->definition
      ];
      //dd($formatted);

      return \Response::json($formatted);

    }

    public function getSQL(Request $request) {

      $id = $request->id;

      if (empty($id)) {
          return \Response::json([]);
      }
      $filter = Filter_user::find($id);
      $table = DB::table('course');
      $qbp = new QueryBuilderParser(
          array( 'title', 'subtitle', 'category', 'is_free', 'author', 'badge', 'last_updated', 'created')
      );
      $query = $qbp->parse($filter->definition, $table);
      $rows = $query->get();
      return Response::JSON($rows);

    }

    public function listCourseFilter(Request $request) {

      $user_id = Auth::User()->id;

      $filters = Filter_user::where(['user_id' => $user_id, 'type' => 'course_filter'])->get();

      $formatted = [];
      foreach ($filters as $f) {
          $formatted[] = [
            'id' => $f->id,
            'name' => $f->name
          ];
      }
      return \Response::json($formatted);

    }

    public function listTopicFilter(Request $request) {

      $user_id = Auth::User()->id;

      $filters = Filter_user::where(['user_id' => $user_id, 'type' => 'topic_filter'])->get();

      $formatted = [];
      foreach ($filters as $f) {
          $formatted[] = [
            'id' => $f->id,
            'name' => $f->name
          ];
      }
      return \Response::json($formatted);

    }

    public function evalFilter(Request $request) {

        $whereRaw = json_decode($request->sql)->sql;
        $ftype = $request->ftype;

        if ($ftype == 'course_filter') {
            $totalData = Course::count();
            $totalFiltered = Course::whereRaw($whereRaw)->count();
            $res = $totalFiltered . ' filtered out of ' . $totalData . ' Courses.';
        } elseif ($ftype == 'topic_filter') {
            $totalData = Topic::count();
            $totalFiltered = Topic::whereRaw($whereRaw)->count();
            $res = $totalFiltered . ' filtered out of ' . $totalData . ' Topics.';
        }

        echo($res);
    }
}
