<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filter_user;
use App\Topic;
use DB;

class TopicController extends Controller
{
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

  public function getData(Request $request)
  {

    //print_r($request->all());
    $columns=  array(
      0 => 'topic',
      1 => 'category',
      2 => 'course_anz',
      3 => 'sum_competitors',
      4 => 'sum_students',
      5 => 'avg_students',
      6 => 'avg_new_students',
      7 => 'sum_new_students',
      8 => 'avg_rating',
      9 => 'avg_engagement',
      10 => 'ttrend_cat',
      11 => 'gtrend_cat',
      12 => 'opportunity_score',
      13 => 'topic_url'
    );

    $totalData = Topic::count();
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
        $results = Topic::whereRaw($whereRaw)->offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Topic::whereRaw($whereRaw)->count();
    } else {
        $results = Topic::offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Topic::count();
    }

    $data = array();

    if($results){
        foreach($results as $r){
            if(strlen($r->topic) > 30) {
              $topic = mb_substr($r->topic, 0, 30).'...' ;
            } else {
              $topic = $r->topic;
            }
            $topic = $r->topic;
            $nestedData['topic'] = '<a title="'.$r->topic.'" href="/course-search?topic_id=' . $r->topic_id . '">'. $topic . '</a>';
            //$nestedData['topic'] = '<a href="/course-search?topic_id=' . $r->topic_id . '">'. $r->topic . '</a>';
            $nestedData['category'] = $r->category;
            $nestedData['course_anz'] = $r->course_anz;
            $nestedData['sum_competitors'] = $r->sum_competitors;
            $nestedData['sum_students'] = $r->sum_students;
            $nestedData['avg_students'] = $r->avg_students;
            $nestedData['avg_new_students'] = $r->avg_new_students;
            $nestedData['sum_new_students'] = $r->sum_new_students;
            $nestedData['avg_rating'] = $r->avg_rating;
            $nestedData['avg_engagement'] = $r->avg_engagement;
            $nestedData['opportunity_score'] = $r->opportunity_score;
            $nestedData['ttrend'] = "<span class='inlinesparkline'>".$r->ttrend."</span>";
            $nestedData['ttrend_value'] = $r->ttrend_value;
            $nestedData['gtrend'] = "<span class='inlinesparkline'>".$r->gtrend."</span>";
            $nestedData['gtrend_value'] = $r->gtrend_value;
            $nestedData['topic_url'] = '<a target="_blank" href="' . $r->topic_url . '"><i class="fa fa-external-link text-navy"></i></a>';
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
          $w = $w . "(" . "sum_new_students >= " . $request->input('minEnrollments') . ")";
      }
      //get maxEnrollments
      if (is_null($request->input('maxEnrollments')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "sum_new_students <= " . $request->input('maxEnrollments') . ")";
      }

      //get minCourses
      if (is_null($request->input('minCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "course_anz >= " . $request->input('minCourses') . ")";
      }
      //get maxCourses
      if (is_null($request->input('maxCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "course_anz <= " . $request->input('maxCourses') . ")";
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

      //get minFreeRation
      if (is_null($request->input('minFree')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "free_ratio >= " . $request->input('minFree') . ")";
      }
      //get maxFreeRatio
      if (is_null($request->input('maxFree')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "free_ratio <= " . $request->input('maxFree') . ")";
      }

      return($w);

  }

}
