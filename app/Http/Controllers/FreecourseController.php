<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Subcategory;
use App\Author;
use App\Topic;
use App\Keyword;
use DB;
use Auth;

class FreecourseController extends Controller
{

	public function freecourses(Request $request)
	{

      $landing = 'freecourses'; //h - home for default
      if ($request->input('lp')) {
      	$landing = $request->input('lp');
      }

      return view(
      	'freecourses',
      	array(
      		'title' => 'The Udemy Course Instructor Research Tool',
      		'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
      		'landing' => $landing,
      		
      	)
      );
  }



    public function searchcategory(Request $request)
    {
     $totalData = Course::where('is_free','1')->count();
     $whereRaw = $this->getWhereRawFromRequest($request);
     $limit = $request->input('length');
     $start = $request->input('start');
     $order = $request->input('order');
      // Here is free is 1//
     if ($whereRaw != '') {
    $results = Course::whereRaw($whereRaw)->where('is_free','1')->offset($start)->limit($limit);
    $results = $results->get();
    $totalFiltered = Course::whereRaw($whereRaw)->where('is_free','1')->count();
    }
    else{
      $results = Course::where('is_free','1')->offset($start)->limit($limit);

      $results = $results->get();
      $totalFiltered = Course::where('is_free','1')->count();

    }
      if (empty($results)) {
        return \Response::json([]);
      }
      $formatted = [];
      foreach ($results as $course) {
        $formatted[] = ['title' => $course->title, 'subcategory' => $course->subcategory, 'topic' => $course->topic, 'duration' => $course->duration, 'rating' => $course->rating, 'reviews' => $course->reviews, 'students' => $course->students, 'course_url' =>'<a target="_blank" href="'.$course->course_url.'"><i class="fa fa-external-link text-navy"></i></a>'];
      }
      $json_data = array(
        "draw"              => intval($request->input('draw')),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalFiltered),
        "data"              => $formatted,
      );
      echo json_encode($json_data);


  }

  private function getWhereRawFromRequest(Request $request)
  {
        #dd($request);
        #return('');

    $w = '';
    $cAll = $request->input('cAll');
    $cDev = $request->input('cDev');
    $cBus = $request->input('cBus');
    $cITS = $request->input('cITS');
    $cOff = $request->input('cOff');
    $cPer = $request->input('cPer');
    $cDes = $request->input('cDes');
    $cMar = $request->input('cMar');
    $cLif = $request->input('cLif');
    $cPho = $request->input('cPho');
    $cHea = $request->input('cHea');
    $cTea = $request->input('cTea');
    $cMus = $request->input('cMus');
    $cAca = $request->input('cAca');
    $cLan = $request->input('cLan');
    $cTes = $request->input('cTes');

    if ($cAll == 'false') {
      $w = 'category IN (';
      if ($cDev == 'true') {$w = $w . ", 'Development'";}
      if ($cBus == 'true') {$w = $w . ", 'Business'";}
      if ($cITS == 'true') {$w = $w . ", 'IT & software'";}
      if ($cOff == 'true') {$w = $w . ", 'Office Productivity'";}
      if ($cPer == 'true') {$w = $w . ", 'Personal Development'";}
      if ($cDes == 'true') {$w = $w . ", 'Design'";}
      if ($cMar == 'true') {$w = $w . ", 'Marketing'";}
      if ($cLif == 'true') {$w = $w . ", 'Lifestyle'";}
      if ($cPho == 'true') {$w = $w . ", 'Photography'";}
      if ($cHea == 'true') {$w = $w . ", 'Health & fitness'";}
      if ($cTea == 'true') {$w = $w . ", 'Teacher training'";}
      if ($cMus == 'true') {$w = $w . ", 'Music'";}
      if ($cAca == 'true') {$w = $w . ", 'Academics'";}
      if ($cLan == 'true') {$w = $w . ", 'Language'";}
      if ($cTes == 'true') {$w = $w . ", 'Test prep'";}

      $w = str_replace('(, ', '(', $w);

      if ($w == 'category IN (') {
        $w = '';
      } else {
        $w = $w . ')';
      }
    }

    if (is_null($request->input('Authors')) == false) {
      if ($w != '') {
        $w = $w . ' AND ' . '(';
      } else {
        $w = '(';
      }

            #$in = explode(',', $request->input('Authors'));
      $in = $request->input('Authors');
      $h = '';
            #target: title like '%eon%' or  title like '%two%'
      foreach ($in as $s) {
        if ($h != '') { $h = $h . ' OR ';}
        $h = $h . "author_id=" . $s;
      }
      $w = $w . $h . ')';
    }

        //get include Keywords
    if (is_null($request->input('IncTags')) == false) {
      if ($w != '') {
        $w = $w . ' AND ' . '(';
      } else {
        $w = '(';
      }
      $rel = ($request->input('IncKeyRel') == 'true') ? ' OR ' : ' AND ';
      $in = explode(',', $request->input('IncTags'));
      $h = '';
            #target: title like '%eon%' or  title like '%two%'
      foreach ($in as $s) {
        if ($h != '') { $h = $h . $rel;}
        $h = $h . "title like '%" . $s . "%'";
      }
      $w = $w . $h . ')';
    }

        //get Topic
    if (is_null($request->input('Topic')) == false) {
      if ($w != '') {
        $w = $w . ' AND ' . '(';
      } else {
        $w = '(';
      }

            #$in = explode(',', $request->input('Authors'));
      $in = $request->input('Topic');
      $h = '';
            #target: title like '%eon%' or  title like '%two%'
      foreach ($in as $s) {
        if ($h != '') { $h = $h . ' OR ';}
        $h = $h . "topic_id=" . $s;
      }
      $w = $w . $h . ')';
    }

        //get Subcategory
    if (is_null($request->input('SubCat')) == false) {
      if ($w != '') {
        $w = $w . ' AND ' . '(';
      } else {
        $w = '(';
      }

            #$in = explode(',', $request->input('Authors'));
      $in = $request->input('SubCat');
      $h = '';
            #target: title like '%eon%' or  title like '%two%'
      foreach ($in as $s) {
        if ($h != '') { $h = $h . ' OR ';}
        $h = $h . "subcategory_id=" . $s;
      }
      $w = $w . $h . ')';
    }

    if (is_null($request->input('Price')) == false) {
      if ($w != '') {$w = $w . " AND ";}
      if ($request->input('Price') == 0)
      {
        if ($w != '') {$w = $w . " AND ";}
        $w = $w . "(is_free = 1)";
      }

      if ($request->input('Price')> 0)
      {
        $w = $w . "(" . "price_old <= " . $request->input('Price') . ")";

      }


    }
    if (is_null($request->input('Discount')) == false) {
      if ($w != '') {$w = $w . " AND ";}
      $w = $w . "(" . "discount_p >= " . $request->input('Discount') . ")";
    }

    


    return($w);

  }

  public function searchAuthors(Request $request) {
    $term = $request->q;

    if (empty($term)) {
      return \Response::json([]);
    }
    $where = "author like '%" . $term . "%'";
    $order = "CASE
    WHEN author = '" . $term . "' THEN 1
    WHEN author like '" . $term . "%' THEN 2
    WHEN author like '%" . $term . "' THEN 4
    ELSE 3
    END
    , author";

    $authors = Author::whereRaw($where)->orderByRaw($order, 'asc')->limit(10)->get();
    $formatted = [];
    foreach ($authors as $author) {
      $formatted[] = ['id' => $author->author_id, 'text' => $author->author];
    }
    return \Response::json($formatted);
  }

  public function searchSubCat(Request $request) {
    $term = $request->q;

    if (empty($term)) {
      return \Response::json([]);
    }
    $where = "subcategory like '%" . $term . "%'";
    $order = "CASE
    WHEN subcategory = '" . $term . "' THEN 1
    WHEN subcategory like '" . $term . "%' THEN 2
    WHEN subcategory like '%" . $term . "' THEN 4
    ELSE 3
    END
    , subcategory";

    $subcats = Subcategory::whereRaw($where)->orderByRaw($order, 'asc')->limit(10)->get();
    $formatted = [];
    foreach ($subcats as $subcat) {
      $formatted[] = ['id' => $subcat->subcategory_id, 'text' => $subcat->subcategory];
    }
    return \Response::json($formatted);
  }


  public function searchTopic(Request $request) {
    $term = $request->q;

    if (empty($term)) {
      return \Response::json([]);
    }
    $where = "topic like '%" . $term . "%'";
    $order = "CASE
    WHEN topic = '" . $term . "' THEN 1
    WHEN topic like '" . $term . "%' THEN 2
    WHEN topic like '%" . $term . "' THEN 4
    ELSE 3
    END
    , topic";

    $topics = Topic::whereRaw($where)->orderByRaw($order, 'asc')->limit(10)->get();
    $formatted = [];
    foreach ($topics as $topic) {
      $formatted[] = ['id' => $topic->topic_id, 'text' => $topic->topic];
    }
    return \Response::json($formatted);
  }
  public function searchKeyword(Request $request) {
    $term = $request->q;

    if (empty($term)) {
      return \Response::json([]);
    }
    $where = "keyword like '%" . $term . "%'";
    $order = "CASE
    WHEN keyword = '" . $term . "' THEN 1
    WHEN keyword like '" . $term . "%' THEN 2
    WHEN keyword like '%" . $term . "' THEN 4
    ELSE 3
    END
    , keyword";

    $keywords = Keyword::whereRaw($where)->orderByRaw($order, 'asc')->limit(10)->get();
    $formatted = [];
    foreach ($keywords as $keyword) {
      $formatted[] = ['id' => $keyword->keyword_id, 'text' => $keyword->keyword];
    }
    return \Response::json($formatted);
  }


  public function courseCoupons(Request $request)
  {

      $landing = 'freecourses'; //h - home for default

      return view(
      	'udemyCouponscodes',
      	array(
      		'title' => 'The Udemy Course Instructor Research Tool',
      		'meta' => 'Build a scalable Udemy business with one powerful solution. Find niche topics, track courses for future sales, and get access to accurate sales data and competitor data with the Teachinguide Web App!',
      		'landing' => $landing,
      		
      	)
      );
    }

    public function searchCouponcouse(Request $request)
    {
      $totalData = Course::join('course_coupon', function ($join) {
        $join->on('course_coupon.course_id', '=', 'course.course_id');
      })->count();
      $whereRaw = $this->getWhereRawFromRequest($request);
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $request->input('order');
    if ($whereRaw != '') {
      $results = Course::join('course_coupon', function ($join) {
        $join->on('course_coupon.course_id', '=', 'course.course_id');
      })->whereRaw($whereRaw)->offset($start)->limit($limit);
      $results = $results->get();
      $totalFiltered = Course::join('course_coupon', function ($join) {
        $join->on('course_coupon.course_id', '=', 'course.course_id');
      })->whereRaw($whereRaw)->count();
    }
    else{
      $results = Course::join('course_coupon', function ($join) {
        $join->on('course_coupon.course_id', '=', 'course.course_id');
      })->offset($start)->limit($limit);

      $results = $results->get();
      $totalFiltered = Course::join('course_coupon', function ($join) {
        $join->on('course_coupon.course_id', '=', 'course.course_id');
      })->count();


    }
      if (empty($results)) {
        return \Response::json([]);
      }

      $formatted = [];
      foreach ($results as $course) {
        $link='<a target="_blank" href="'.$course->link.'?couponCode='.$course->coupon_code.'" ><i class="fa fa-external-link text-navy"></i></a>';
        $formatted[] = 
        ['title' => $course->title, 'subcategory' => $course->subcategory, 'topic' => $course->topic, 'duration' => $course->duration, 'rating' => $course->rating, 'reviews' => $course->reviews, 'students' => $course->students,'couponcode' => $course->coupon_code, 'discount' => $course->discount_p, 'price' => $course->price_old ,'course_url' =>$link];
      }
      $json_data = array(
        "draw"              => intval($request->input('draw')),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalFiltered),
        "data"              => $formatted,
      );

      echo json_encode($json_data);
      

    }

  }
