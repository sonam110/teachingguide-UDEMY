<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Keyword;
use DB;

class KeywordController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
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

  public function getData(Request $request)
  {

    //print_r($request->all());
    $columns=  array(
      0 => 'keyword',
      1 => 'topic',
      2 => 'relevance',
      3 => 'category',
      4 => 'utraffic_category',
      5 => 'gtraffic_category',
      6 => 'gCPC',
      7 => 'gCompetition',
      8 => 'kd',
      9 => 'cps',
      10 => 'reviews',
      11 => 'keywordCount',
      12 => 'rating',
      13 => 'students',
      14 => 'gtrend12m_cat',
      15 => 'gtrend_cat',
      16 => 'opportunity_score'
    );
    if (is_null($request->input('Topic'))) {
        $columns[2] = 'topic_relevance';
    }

    $totalData = Keyword::count();
    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $request->input('order');

    $whereRaw = $this->getWhereRawFromRequest($request);

    if ($whereRaw != '') {
        if (is_null($request->input('Topic'))) {
            $results = Keyword::whereRaw($whereRaw)->offset($start)->limit($limit);
            foreach($order as $o) {
                $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
            }
            $results = $results->get();
            $totalFiltered = Keyword::whereRaw($whereRaw)->count();
        } else {
            $results = Keyword::whereRaw($whereRaw)->offset($start)->join('topic_keywords','topic_keywords.keyword_id','=','keyword.keyword_id')->limit($limit);
            foreach($order as $o) {
                $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
            }
            $results = $results->get();
            $totalFiltered = Keyword::whereRaw($whereRaw)->join('topic_keywords','topic_keywords.keyword_id','=','keyword.keyword_id')->count();
        }

    } else {
        $results = Keyword::offset($start)->limit($limit);
        foreach($order as $o) {
            $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
        }
        $results = $results->get();
        $totalFiltered = Keyword::count();
    }

    $data = array();
    //dd($results);
    if($results){
        //dd($results);
        foreach($results as $r){
            if(strlen($r->keyword) > 30) {
              $keyword = mb_substr($r->keyword, 0, 30) .'...';
              $nestedData['keyword'] = '<span class="top" title="'.$r->keyword.'" data-original-title="'.$r->keyword.'">'.$keyword.'</span>';
            } else {
              $nestedData['keyword'] = $r->keyword;
            }
            $nestedData['keyword'] = $r->keyword;

            if(strlen($r->topic) > 20) {
              $topic = mb_substr($r->topic, 0, 20).'...' ;
            } else {
              $topic = $r->topic;
            }
            $topic = $r->topic;
            $nestedData['topic'] = '<a title="'.$r->topic.'" href="/course-search?topic_id=' . $r->topic_id . '">'. $topic . '</a>';
            //$nestedData['topic'] = $r->topic;
            $nestedData['category'] = $r->category;
            if (is_null($request->input('Topic'))) {
                $nestedData['relevance'] = $r->topic_relevance;
            } else {
                $nestedData['relevance'] = $r->relevance;
            }
            //$nestedData['frequency'] = $r->frequency;
            //$nestedData['search_results'] = $r->search_results;
            $nestedData['utraffic'] = $r->utraffic_category;
            $nestedData['gtraffic'] = $r->gtraffic_category;
            $nestedData['gCPC'] = $r->gCPC;
            $nestedData['gCompetition'] = $r->gCompetition;
            $nestedData['kd'] = $r->kd;
            $nestedData['cps'] = $r->cps;
            $nestedData['reviews'] = $r->reviews;
            $nestedData['usage'] = $r->keywordCount;
            $nestedData['rating'] = $r->rating;
            $nestedData['students'] = $r->students;
            $nestedData['gtrend12m'] = "<span class='inlinesparkline'>".$r->gtrend12m."</span>";
            $nestedData['gtrend'] = "<span class='inlinesparkline'>".$r->gtrend."</span>";
            $nestedData['opportunity'] = $r->opportunity_score;
            $nestedData['link'] = '<a target="_blank" href="https://www.udemy.com/courses/search/?q=' . $r->keyword . '"><i class="fa fa-external-link text-navy"></i></a>';
            $nestedData['gtrend12m_value'] = $r->gtrend_value;
            $nestedData['gtrend_value'] = $r->gtrend_value;
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
              $h = $h . "keyword like '%" . $s . "%'";
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
              $h = $h . "keyword not like '%" . $s . "%'";
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
              $h = $h . "topic_keywords.kw_topic_id=" . $s;
          }
          $w = $w . $h . ')';
      }

      //get minRating
      if (is_null($request->input('minRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "rating >= " . $request->input('minRating') . ")";
      }
      //get maxRating
      if (is_null($request->input('maxRating')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "rating <= " . $request->input('maxRating') . ")";
      }

      //get minReviews
      if (is_null($request->input('minReviews')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "reviews >= " . $request->input('minReviews') . ")";
      }
      //get maxReviews
      if (is_null($request->input('maxReviews')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "reviews <= " . $request->input('maxReviews') . ")";
      }
      //get minFrequency
      if (is_null($request->input('minStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "Students >= " . $request->input('minStudents') . ")";
      }
      //get maxStudents
      if (is_null($request->input('maxStudents')) == false) {
          if ($w != '') {$w = $w . " AND ";}
          $w = $w . "(" . "Students <= " . $request->input('maxStudents') . ")";
      }


      //get Traffic Category
      if (is_null($request->input('UTraffic')) == false) {
          if ($w != '') {
              $w = $w . ' AND ' . '(';
          } else {
              $w = '(';
          }

          #$in = explode(',', $request->input('Authors'));
          $in = $request->input('UTraffic');
          $h = '';
          #target: title like '%eon%' or  title like '%two%'
          foreach ($in as $s) {
              if ($h != '') { $h = $h . ' OR ';}
              $h = $h . "utraffic_category=" . $s;
          }
          $w = $w . $h . ')';
      }

      //get Trend Category
      if (is_null($request->input('UTrend')) == false) {
          if ($w != '') {
              $w = $w . ' AND ' . '(';
          } else {
              $w = '(';
          }

          #$in = explode(',', $request->input('Authors'));
          $in = $request->input('UTrend');
          $h = '';
          #target: title like '%eon%' or  title like '%two%'
          foreach ($in as $s) {
              if ($h != '') { $h = $h . ' OR ';}
              $h = $h . "utrend_cat=" . $s;
          }
          $w = $w . $h . ')';
      }
      //get 12mTrend Category
      if (is_null($request->input('Trend12m')) == false) {
          if ($w != '') {
              $w = $w . ' AND ' . '(';
          } else {
              $w = '(';
          }

          #$in = explode(',', $request->input('Authors'));
          $in = $request->input('Trend12m');
          $h = '';
          #target: title like '%eon%' or  title like '%two%'
          foreach ($in as $s) {
              if ($h != '') { $h = $h . ' OR ';}
              $h = $h . "gtrend12m_cat=" . $s;
          }
          $w = $w . $h . ')';
      }

      return($w);

  }
}
