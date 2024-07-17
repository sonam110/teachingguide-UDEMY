<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Course;
use Carbon\Carbon;
use DB;
use Auth;
use App\Monitor_course;
use App\CourseLink;

class MonitorController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public function MonitorAddCourse(Request $request)
  {

    if ($request->input("course_id"))
    {
        $ctime = Carbon::now()->toDateTimeString();

        $user_id = Auth::User()->id;
        //$user_id = $request->input("user_id");
        $course_id = $request->input('course_id');

        $match = ['user_id' => $user_id, 'course_id' => $course_id];
        $mcourse = Monitor_course::where($match)->first();

        $courseCount = Monitor_course::where(['user_id' => $user_id])->count();

        //check wether still slots available
        $slots = 0;
        $remain = 0;
        $subscription = Subscription::where('user_id', $user_id)->first();
        if (MemberController::hasCompete() == 1) {
            $slots = 20;
        } elseif (MemberController::hasInsight() == 1) {
            $slots = 5;
        } else {
            $slots = 0;
        }

        $remain = $slots - $courseCount;
        if ($remain <= 0) {
            return -1;
        }

        if ($mcourse === null) {

           Monitor_course::create(array('user_id' => $user_id, 'course_id' => $course_id, 'updated_at' => $ctime, 'created_at' => $ctime));
           return 1;
        } else {
           return 0;
        }
    }
  }

  public function MonitorDelCourse(Request $request)
  {

    if ($request->input("course_id"))
    {
        $ctime = Carbon::now()->toDateTimeString();

        $user_id = Auth::User()->id;
        //$user_id = $request->input("user_id");
        $course_id = $request->input('course_id');

        $match = ['user_id' => $user_id, 'course_id' => $course_id];
        $mcourse = Monitor_course::where($match)->first();
        if ($mcourse != null) {
           Monitor_course::where($match)->delete();
           return 1;
        } else {
           return 0;
        }

    }
  }

  public function MonitorCourseChart(Request $request)
  {
    $axisPadding = 0.15;

    if ($request->input("course_id"))
    {
      $course_id = $request->input("course_id");
      $sqlCourse = "SELECT week, students FROM `course_weekly_sales` WHERE course_id = ". $course_id ." ORDER BY year, week";
      $results = DB::select($sqlCourse);

      $sqlTrend = "SELECT t.ttrend as ttrend from topic as t INNER JOIN course as c ON t.topic_id = c.topic_id WHERE c.course_id = ". $course_id;
      $ttrendString = DB::select($sqlTrend)[0]->ttrend;
      $ttrendArray = array_map('intval', explode(',', $ttrendString));
      $maxTrend = round(max($ttrendArray) * (1 + $axisPadding));
      $minTrend = round(min($ttrendArray) - (min($ttrendArray) * $axisPadding));
      $minTrend = ($minTrend < 0 ? 0 : $minTrend);

      $sqlWeeks = "SELECT week FROM `course_weekly_sales` group by year, week order by year DESC, week DESC limit 10";
      $resWeeks = DB::select($sqlWeeks);

      $sqlTopic = "SELECT c.topic as topic from course as c WHERE c.course_id = ". $course_id;
      $topic = DB::select($sqlTopic)[0]->topic;

      $data = array();
      $maxCourse = 0;
      $minCourse = 10000000;

      if($results){
          foreach($results as $r){
              $nestedData['week'] = $r->week;
              $nestedData['students'] = $r->students;
              $data[] = $nestedData;
              $minCourse = ($r->students < $minCourse) ? $r->students : $minCourse;
              $maxCourse = ($r->students > $maxCourse) ? $r->students : $maxCourse;
          }
      }
      $minCourse = round($minCourse - $minCourse * $axisPadding);
      $minCourse = ($minCourse < 0 ? 0 : $minCourse);
      $maxCourse = round($maxCourse * (1 + $axisPadding));

      $weeks = array();
      if($resWeeks) {
        $index = count($resWeeks);
        while($index) {
          $weeks[] = $resWeeks[--$index];
        }

        //foreach($resWeeks as $w){
            //$weeks[] = $w;
        //}
      }

      $json_data = array(
          "draw"              => intval($request->input('draw')),
          "data"              => $data,
          "ttrend"            => $ttrendString,
          "weeks"             => $weeks,
          "minCourse"         => $minCourse,
          "maxCourse"         => $maxCourse,
          "minTrend"          => $minTrend,
          "maxTrend"          => $maxTrend,
          "topic"             => $topic
      );

      echo json_encode($json_data);
    }
  }

  public function MonitorRatingChart(Request $request)
  {

    if ($request->input("course_id"))
    {
      $course_id = $request->input("course_id");
      $sql = "SELECT week, rating FROM `course_weekly_sales` WHERE course_id = ". $course_id ." ORDER BY year, week";
      $results = DB::select($sql);

      $data = array();

      if($results){
          foreach($results as $r){
              $nestedData['week'] = $r->week;
              $nestedData['rating'] = $r->rating;
              $data[] = $nestedData;
          }
      }

      $json_data = array(
          "draw"              => intval($request->input('draw')),
          "data"              => $data
      );

      echo json_encode($data);
    }
  }

  public function getMonitoredCourses(Request $request)
  {
    $user_id = Auth::User()->id;

    $columns=  array(
      0 => 'title',
      1 => 'subcategory',
      2 => 'subcategory_rank',
      3 => 'price',
      4 => 'badge',
      5 => 'author',
      6 => 'topic',
      7 => 'rating',
      8 => 'students',
      9 => 'reviews',
      10 => 'engagement',
      11 => 'sales',
      12 => 'is_promo',
      13 => 'kwrp',
      14 => 'blp',
      15 => 'ctrend_value',
      16 => 'last_updated',
      17 => 'course_url',
      18 => 'status',
      19 => 'course_id'
    );

    $order = $request->input('order');

    $rawSql = "select
            	course.title
              , course.subcategory
              , course.subcat_chg
              , course.subcat_diff
              , course.subcategory_rank
              , course.badge
              , course.price
            	, course.author
              , course.author_id
            	, course.topic
              , course.topic_id
            	, course.rating
            	, course.students
              , course.reviews
              , course.engagement
              , course.sales
              , course.kwrp
              , course.blp
              , course.is_promo
              , course.is_free
            	, course.course_url
            	, course.last_updated
              , course.ctrend
              , course.ctrend_value
              , monitor_course.status
              , course.course_id
            from
            	monitor_course
            	inner join course on monitor_course.course_id = course.course_id
            where
              monitor_course.user_id = ". $user_id;
    $sql = $rawSql . " order by ";
    $orderClause = '';
    foreach($order as $o) {
        if ($orderClause != '') {
            $orderClause .= ', ';
        }
        $orderClause .= $columns[$o["column"]] . ' '. $o["dir"];
    }
    $sql = $rawSql . " order by " . $orderClause;
    $results = DB::select($sql);

    $data = array();

    if($results){
        foreach($results as $r){
            $nestedData['id'] = $r->course_id;
            if(strlen($r->title) > 40) {
              $title = mb_substr($r->title, 0, 40) .'...';
            } else {
              $title = $r->title;
            }
            $title = $r->title;

            if ($r->is_free == 1) {
                $nestedData['title'] = '<strong>(Free) </strong><span class="top" title="'.$r->title.'" data-original-title="'.$r->title.'">'.$title.'</span>';
            } else {
                $nestedData['title'] = '<span class="top" title="'.$r->title.'" data-original-title="'.$r->title.'">'.$title.'</span>';
            }
            $nestedData['scrank'] = $this->getSubCatChangeHTML($r->subcategory_rank, $r->subcat_chg, $r->subcat_diff);
            $nestedData['subcategory'] = $r->subcategory;
            //$nestedData['srank'] = $r->rank;
            $nestedData['sales'] = $r->sales;
            $nestedData['price'] = $r->price;
            $nestedData['kwrp'] = $r->kwrp;
            $nestedData['blp'] = $r->blp;
            $nestedData['is_promo'] = $r->is_promo==1 ? 'Yes': 'No';

            $nestedData['trend'] = "<span class='inlinesparkline'>".$r->ctrend."</span>";
            $nestedData['ctrend_value'] = $r->ctrend_value;
            $nestedData['badge'] = $r->badge;
            //$nestedData['author'] = $r->author;
            $nestedData['author'] = '<a href="/course-search?author_id=' . $r->author_id . '">'. $r->author . '</a>';
            $nestedData['last_updated'] = $r->last_updated;
            //$nestedData['topic'] = $r->topic;
            if(strlen($r->topic) > 20) {
              $topic = mb_substr($r->topic, 0, 20).'...' ;
            } else {
              $topic = $r->topic;
            }
            $nestedData['topic'] = '<a title="'.$r->topic.'" href="/course-search?topic_id=' . $r->topic_id . '">'. $topic . '</a>';
            $nestedData['students'] = $r->students;
            $nestedData['rating'] = $r->rating;
            $nestedData['reviews'] = $r->reviews;
            $nestedData['engagement'] = $r->engagement;
            $nestedData['link'] = '<a target="_blank" href="' . $r->course_url . '"><i class="fa fa-external-link text-navy"></i></a>';
            $nestedData['status'] = $r->status==1 ? '<img src="'.url('/').'/assets/img/loading.gif" style="width: 50px; height: 15px;">': '<i class="fa fa-check-square-o text-navy"></i>';
            $data[] = $nestedData;
        }
    }

    $json_data = array(
        "draw"              => intval($request->input('draw')),
        "data"              => $data
    );

    echo json_encode($json_data);

  }

  private function getSubCatChangeHTML($rank, $chg, $diff)
  {
      $html = '';
      switch ($chg) {
        case 1: $html = '<span style="float:left;min-width:2em;">'.$rank.'</span><span class="text-warning"><i class="fa fa-star">&nbsp;new</span>'; break;
        case 2: $html = '<span style="float:left;min-width:2em;">'.$rank.'</span><span class="text-navy"><i class="fa fa-play fa-rotate-270"></i>&nbsp;+' . $diff . '</span>'; break;
        case 3: $html = '<span style="float:left;min-width:2em;">'.$rank.'</span><span class="text-danger"><i class="fa fa-play fa-rotate-90"></i>&nbsp;' . $diff . '</span>'; break;
        case 4: $html = '<span style="float:left;min-width:2em;">'.$rank.'</span><span><i class="fa fa-stop"></i></span>'; break;
        case 5: $html = '<span style="float:left;min-width:2em;">'.$rank.'</span><span class="text-danger"><i class="fa fa-trash"></i>&nbsp;lost</span>'; break;
      }

      return ($html);
  }

  public function getCourseRankings(Request $request)
  {
    if ($request->input("course_id"))
    {
        $user_id = Auth::User()->id;
        $columns=  array(
          0 => 'keyword',
          1 => 'topic',
          2 => 'rank',
          3 => 'diff',
          4 => 'rank_date',
          5 => 'utraffic_category'

        );
        $course_id = $request->input("course_id");
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $rawSql = "select
                	keyword.keyword
                	, keyword.topic
                	, keyword.utraffic_category
                	, keyword_ranking.rank
                	, keyword_ranking.rank_date
                  , keyword_ranking.chg
                  , keyword_ranking.last
                  , keyword_ranking.diff
                from
                	monitor_course
                	inner join keyword_ranking on monitor_course.course_id = keyword_ranking.course_id
                  inner join keyword on keyword.keyword_id = keyword_ranking.keyword_id
                WHERE
                  monitor_course.user_id = ". $user_id. "
                	AND keyword_ranking.course_id = ".$course_id;
        $sql = $rawSql . " order by " . $order . " " . $dir . " limit " . $start . ", " .$limit;
        $results = DB::select($sql);
        $totalData = DB::select("select count(*) from keyword_ranking");
        $totalFiltered = count(DB::select($rawSql));

        $data = array();

        if($results){
            foreach($results as $r){
                if(strlen($r->keyword) > 30) {
                  $keyword = mb_substr($r->keyword, 0, 27) . '...';
                } else {
                  $keyword = $r->keyword;
                }
                $nestedData['keyword'] = $keyword;
                $nestedData['topic'] = $r->topic;
                $nestedData['traffic_category'] = $r->utraffic_category;
                $nestedData['rank'] = $r->rank;
                $nestedData['rank_date'] = $r->rank_date;
                $nestedData['chg'] = $this->getChangeHTML($r->chg, $r->diff, $r->last);
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"              => intval($request->input('draw')),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }
  }

  public function getCourseLinks(Request $request)
  {
    if ($request->input("course_id"))
    {
        $course_id = $request->course_id;
        $columns=  array(
          0 => 'ref_page',
          1 => 'ur',
          2 => 'dr',
          3 => 'domains',
          4 => 'bl',
          5 => 'ext',
          6 => 'int',
          7 => 'traffic',
          8 => 'kw',
          9 => 'type',
          10 => 'age'
        );
        $course_id = $request->input("course_id");
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->input('order');

        $results = CourseLink::where('course_id', $course_id)->offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();

        $totalData = CourseLink::count();
        $totalFiltered = CourseLink::where('course_id', $course_id)->count();

        $data = array();

        if($results){
            foreach($results as $r){
                if(strlen($r->ref_page) > 70) {
                  $ref_page = mb_substr($r->ref_page, 0, 70) . '...';
                } else {
                  $ref_page = $r->ref_page;
                }
                $nestedData['ref_title'] = $r->ref_title;
                $nestedData['ref_page'] = $ref_page;
                $nestedData['ref_url'] = $r->ref_page;
                $nestedData['link'] = '<a title="'. $r->ref_title .'" target="_blank" href="' . $r->ref_page . '"><i class="fa fa-external-link text-navy">&nbsp;</i>' . $ref_page . '</a>';
                $nestedData['dr'] = $r->dr;
                $nestedData['bl'] = $r->bl;
                $nestedData['ur'] = $r->ur;
                $nestedData['domains'] = $r->domains;
                $nestedData['ext'] = $r->ext;
                $nestedData['int'] = $r->int;
                $nestedData['traffic'] = $r->traffic;
                $nestedData['kw'] = $r->kw;
                $nestedData['age'] = $r->age;
                $nestedData['type'] = $r->link_type;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"              => intval($request->input('draw')),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }
  }

  private function getChangeHTML($chg, $diff, $last)
  {
      switch ($chg) {
        case 1: $html = '<span class="text-warning"><i class="fa fa-star">&nbsp;new</span>'; break;
        case 2: $html = '<span class="text-navy"><i class="fa fa-play fa-rotate-270"></i>&nbsp;+' . $diff . '</span>'; break;
        case 3: $html = '<span class="text-danger"><i class="fa fa-play fa-rotate-90"></i>&nbsp;' . $diff . '</span>'; break;
        case 4: $html = '<span><i class="fa fa-stop"></i>&nbsp;0</span>'; break;
        case 5: $html = '<span class="text-danger"><i class="fa fa-trash"></i>&nbsp;lost</span>'; break;
      }

      return ($html);
  }
}
