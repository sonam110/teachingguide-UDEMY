<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filter_user;
use App\Subcategory;
use DB;

class SubCatController extends Controller
{
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

  public function getData(Request $request)
  {

    //print_r($request->all());
    $columns=  array(
      0 => 'subcategory',
      1 => 'category',
      2 => 'authors',
      3 => 'topics',
      4 => 'courses',
      5 => 'avg_duration',
      6 => 'price',
      7 => 'avg_rating',
      8 => 'avg_engagement',
      9 => 'students',
      10 => 'reviews',
      11 => 'engagement',
      12 => 'top_students',
      13 => 'top_reviews',
      14 => 'sales30',
      15 => 'sctrend_value'
    );

    $totalData = Subcategory::count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $request->input('order');

    $useCustomFilter = $request->input('useCustomFilter');
    $customFilterID = $request->input('customFilterID');

    if ($useCustomFilter == 1) {
        //get sql for filter id
        $filter = Filter_user::find($customFilterID);
        $whereRaw = json_decode($filter->sql_where)->sql;
    } else {
        $whereRaw = $this->getWhereRawFromRequest($request);
    }

    if ($whereRaw != '') {
        $results = Subcategory::whereRaw($whereRaw)->offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Subcategory::whereRaw($whereRaw)->count();
    } else {
        $results = Subcategory::offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Subcategory::count();
    }

    $data = array();

    if($results){
        foreach($results as $r){
            $subcategory = $r->subcategory;
            $nestedData['subcategory'] = '<a title="'.$r->topic.'" href="/course-search?subcat_id=' . $r->subcategory_id . '">'. $subcategory . '</a>';
            $nestedData['category'] = $r->category;
            $nestedData['instructors'] = $r->authors;
            $nestedData['topics'] = $r->topics;
            $nestedData['courses'] = $r->courses;
            $nestedData['avg_length'] = $r->avg_duration;
            $nestedData['avg_price'] = $r->price;
            $nestedData['avg_rating'] = $r->avg_rating;
            $nestedData['avg_engagement'] = $r->avg_engagement;
            $nestedData['students'] = $r->students;
            $nestedData['reviews'] = $r->reviews;
            $nestedData['engagement'] = $r->engagement;
            $nestedData['top_students'] = $r->top_students;
            $nestedData['top_reviews'] = $r->top_reviews;
            $nestedData['sales30'] = $r->sales30;
            $nestedData['trend'] = "<span class='inlinesparkline'>".$r->sctrend."</span>";
            $data[] = $nestedData;
        }
    }

    $json_data = array(
        "draw"              => intval($request->input('draw')),
        "recordsTotal"      => intval($totalData),
        "recordsFiltered"   => intval($totalFiltered),
        "data"              => $data
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
              $h = $h . "topic like '%" . $s . "%'";
          }
          $w = $w . $h . ')';
      }

      //get exclude Keywords
      if (is_null($request->input('ExcTags')) == false) {
          if ($w != '') {
              $w = $w . ' AND ' . '(';
          } else {
              $w = '(';
          }

          $out = explode(',', $request->input('ExcTags'));
          $h = '';
          #target: title like '%eon%' or  title like '%two%'
          foreach ($out as $s) {
              if ($h != '') { $h = $h . ' AND ';}
              $h = $h . "topic not like '%" . $s . "%'";
          }
          $w = $w . $h . ')';
      }

      //get minEnrollments
      if (is_null($request->input('minEnrollments')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "sales30 >= " . $request->input('minEnrollments') . ")";
      }
      //get maxEnrollments
      if (is_null($request->input('maxEnrollments')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "sales30 <= " . $request->input('maxEnrollments') . ")";
      }

      //get minCourses
      if (is_null($request->input('minCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "courses >= " . $request->input('minCourses') . ")";
      }
      //get maxCourses
      if (is_null($request->input('maxCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "courses <= " . $request->input('maxCourses') . ")";
      }

      //get minAvgRating
      if (is_null($request->input('minAvgRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "avg_rating >= " . $request->input('minAvgRating') . ")";
      }
      //get maxAvgRating
      if (is_null($request->input('maxAvgRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "avg_rating <= " . $request->input('maxAvgRating') . ")";
      }

      return($w);

  }
}
