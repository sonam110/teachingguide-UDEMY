<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use DB;

class AuthorController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
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

  public function getData(Request $request)
  {

    #print_r($request->all());
    $columns=  array(
      0 => 'author',
      1 => 'course_counts',
      2 => 'avg_duration',
      3 => 'review_points',
      4 => 'students',
      5 => 'review_counts',
      6 => 'engagement',
      7 => 'avg_students',
      8 => 'avg_new_students',
      9 => 'sum_new_students',
      10 => 'avg_reviews',
      11 => 'atrend_value',
      12 => 'author_url'
    );

    $totalData = Author::count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $request->input('order');

    $whereRaw = $this->getWhereRawFromRequest($request);

    if ($whereRaw != '') {
        $results = Author::whereRaw($whereRaw)->offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Author::whereRaw($whereRaw)->count();
    } else {
        $results = Author::offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Author::count();
    }

    $data = array();

    if($results){
        foreach($results as $r){
            if(strlen($r->author) > 20) {
              $author = mb_substr($r->author, 0, 20).'...' ;
            } else {
              $author= $r->author;
            }
            $author= $r->author;
            $nestedData['author'] = '<a title="'.$r->author.'" href="/course-search?author_id=' . $r->author_id . '">'. $author . '</a>';
            //$nestedData['author'] = '<a href="/course-search?author_id=' . $r->author_id . '">'. $r->author . '</a>';
            $nestedData['courses'] = $r->course_counts;
            $nestedData['avg_duration'] = $r->avg_duration;
            $nestedData['rating'] = $r->review_points;
            $nestedData['students'] = $r->students;
            $nestedData['reviews'] = $r->review_counts;
            $nestedData['avg_students'] = $r->avg_students;
            $nestedData['avg_new_students'] = $r->avg_new_students;
            $nestedData['sum_new_students'] = $r->sum_new_students;
            $nestedData['avg_reviews'] = $r->avg_reviews;
            $nestedData['engagement'] = $r->engagement;
            $nestedData['atrend'] = "<span class='inlinesparkline'>".$r->atrend."</span>";
            $nestedData['atrend_value'] = $r->atrend_value;
            $nestedData['link'] = '<a target="_blank" href="' . $r->author_url . '"><i class="fa fa-external-link text-navy"></i></a>';
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

      //get include Keywords
      if (is_null($request->input('IncTags')) == false) {
          if ($w != '') {
              $w = $w . ' AND ' . '(';
          } else {
              $w = '(';
          }

          $in = explode(',', $request->input('IncTags'));
          $h = '';
          #target: title like '%eon%' or  title like '%two%'
          foreach ($in as $s) {
              if ($h != '') { $h = $h . ' OR ';}
              $h = $h . "author like '%" . $s . "%'";
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
              $h = $h . "author not like '%" . $s . "%'";
          }
          $w = $w . $h . ')';
      }

      //get minStudents
      if (is_null($request->input('minStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "students >= " . $request->input('minStudents') . ")";
      }
      //get maxStudents
      if (is_null($request->input('maxStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "students <= " . $request->input('maxStudents') . ")";
      }

      //get minStudents
      if (is_null($request->input('minNewStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "sum_new_students >= " . $request->input('minNewStudents') . ")";
      }
      //get maxStudents
      if (is_null($request->input('maxNewStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "sum_new_students <= " . $request->input('maxNewStudents') . ")";
      }

      //get minCourses
      if (is_null($request->input('minCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "course_counts >= " . $request->input('minCourses') . ")";
      }
      //get maxCourses
      if (is_null($request->input('maxCourses')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "course_counts <= " . $request->input('maxCourses') . ")";
      }

      //get minRatings
      if (is_null($request->input('minRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "review_points >= " . $request->input('minRating') . ")";
      }
      //get maxRatings
      if (is_null($request->input('maxRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "review_points <= " . $request->input('maxRating') . ")";
      }

      return($w);

  }
}
