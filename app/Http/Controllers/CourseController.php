<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Filter_user;
use App\Monitor_course;
use Auth;
use DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function searchCourse(Request $request) {
        $term = $request->q;

        if (empty($term)) {
            return \Response::json([]);
        }
        $where = "title like '%" . $term . "%' OR course_url like '%" . $term . "%'";
        $order = "CASE
                    WHEN title = '" . $term . "' OR course_url = '" . $term . "' THEN 1
                    WHEN title like '" . $term . "%' OR course_url like '" . $term . "%' THEN 3
                    WHEN title like '%" . $term . "' THEN 4
                    ELSE 3
                  END
                  , title";

        $courses = Course::whereRaw($where)->orderByRaw($order, 'asc')->limit(10)->get();
        $formatted = [];
        foreach ($courses as $course) {
            $formatted[] = ['id' => $course->course_id, 'text' => $course->title];
        }
         return \Response::json($formatted);
    }

    public function getData(Request $request)
    {
        
      $user_id = Auth::User()->id;

      //print_r($request->all());
      $columns=  array(
        0 => 'title',
        1 => 'duration',
        2 => 'level',
        3 => 'last_updated',
        4 => 'created',
        5 => 'price',
        6 => 'subcategory',
        7 => 'subcategory_rank',
        8 => 'badge',
        9 => 'author',
        10 => 'topic',
        11 => 'rating',
        12 => 'students',
        13 => 'reviews',
        14 => 'engagement',
        15 => 'sales',
        16 => 'ctrend_value',
        17 => 'is_promo',
        18 => 'kwrp',
        19 => 'blp',
        20 => 'link',
        21 => 'course_id'
      );

      $totalData = Course::count();
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
          $results = Course::whereRaw($whereRaw)->offset($start)->limit($limit);
          foreach($order as $o) {
              $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
          }
          $results = $results->get();
          $totalFiltered = Course::whereRaw($whereRaw)->count();
      } else {
          $results = Course::offset($start)->limit($limit);
          foreach($order as $o) {
              $results = $results->orderBy($columns[$o["column"]], $o["dir"]);
          }
          $results = $results->get();
          $totalFiltered = Course::count();
      }

      //get monitor courses to checks
      $monitorCourses = Monitor_course::where('user_id', $user_id)->pluck('course_id')->toArray();

      $data = array();

      if($results){
          foreach($results as $r){
              if(strlen($r->title) > 40) {
                $title = mb_substr($r->title, 0, 40) .'...';
              } else {
                $title = $r->title;
              }
              $title = $r->title;
              $nestedData['duration'] = $r->duration;
              $nestedData['level'] = $r->level;
              $nestedData['last_updated'] = $r->last_updated;
              $nestedData['created'] = $r->created;

              if ($r->is_free == 1) {
                  $nestedData['title'] = '<strong>(Free) </strong><span class="top" title="'.$r->title.'" data-original-title="'.$r->title.'">'.$title.'</span>';
              } else {
                  $nestedData['title'] = '<span class="top" title="'.$r->title.'" data-original-title="'.$r->title.'">'.$title.'</span>';
              }
              $nestedData['rank'] = $this->getSubCatChangeHTML($r->subcategory_rank, $r->subcat_chg, $r->subcat_diff);
              $nestedData['subcategory'] = $r->subcategory;
              $nestedData['badge'] = $r->badge;
              if(strlen($r->author) > 21) {
                $author = mb_substr($r->author, 0, 21);
                $nestedData['author'] = '<span class="top" title="'.$r->author.'" data-original-title="'.$r->author.'">'.$author.'</span>';
              } else {
                $nestedData['author'] = $r->author;
              }
              if(strlen($r->topic) > 20) {
                $topic = mb_substr($r->topic, 0, 20).'...' ;
              } else {
                $topic = $r->topic;
              }
              $topic = $r->topic;
              $nestedData['topic'] = '<a title="'.$r->topic.'" href="/course-search?topic_id=' . $r->topic_id . '">'. $topic . '</a>';
              $nestedData['rating'] = $r->rating;
              $nestedData['students'] = $r->students;
              $nestedData['reviews'] = $r->reviews;
              $nestedData['engagement'] = $r->engagement;
              $nestedData['sales'] = $r->sales;
              $nestedData['price'] = $r->price;
              $nestedData['ctrend'] = "<span class='inlinesparkline'>".$r->ctrend."</span>";
              $nestedData['ctrend_value'] = $r->ctrend_value;
              $nestedData['is_promo'] = $r->is_promo==1 ? 'Yes': 'No';
              $nestedData['kwrp'] = $r->kwrp;
              $nestedData['blp'] = $r->blp;
              if (in_array($r->course_id, $monitorCourses)) {
                  $nestedData['monitor'] = 1;
              } else {
                  $nestedData['monitor'] = 0;
              }
              $nestedData['link'] = '<a target="_blank" href="' . $r->course_url . '"><i class="fa fa-external-link text-navy"></i></a>';
              $nestedData['course_id'] = $r->course_id;
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
        //get include Authors
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
                $h = $h . "title not like '%" . $s . "%'";
            }
            $w = $w . $h . ')';
        }

        //get level
        if (is_null($request->input('Level')) == false) {
            if ($w != '') {
                $w = $w . ' AND ' . '(';
            } else {
                $w = '(';
            }

            #$in = explode(',', $request->input('Authors'));
            $in = $request->input('Level');
            $h = '';
            #target: title like '%eon%' or  title like '%two%'
            foreach ($in as $s) {
                if ($h != '') { $h = $h . ' OR ';}
                $h = $h . "Level='" . $s . "'";
            }
            $w = $w . $h . ')';
        }
        //get  Badges
        if (is_null($request->input('Prices')) == false) {
          $p = $request->input('Prices');
            if ($w != '') {
                if ($p == 'Free') {
                    $w = $w . ' AND ' . '(is_free = 1)';
                }
                if ($p == 'Paid') {
                    $w = $w . ' AND ' . '(is_free = 0)';
                }
            } else {
              if ($p == 'Free') {
                  $w = $w . '(is_free = 1)';
              }
              if ($p == 'Paid') {
                  $w = $w . '(is_free = 0)';
              }
            }
        }

        //get  Badges
        if (is_null($request->input('Badge')) == false) {
            if ($w != '') {
                $w = $w . ' AND ' . '(';
            } else {
                $w = '(';
            }

            #$in = explode(',', $request->input('Authors'));
            $in = $request->input('Badge');
            $h = '';
            #target: title like '%eon%' or  title like '%two%'
            foreach ($in as $s) {
                if ($h != '') { $h = $h . ' OR ';}
                $h = $h . "Badge='" . $s . "'";
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

        //get minRank
        if (is_null($request->input('minRank')) == false) {
            if ($w != '') {$w = $w . " AND ";}
            $w = $w . "(" . "subcategory_rank >= " . $request->input('minRank') . ")";
        }
        //get maxRank
        if (is_null($request->input('maxRank')) == false) {
            if ($w != '') {$w = $w . " AND ";}
            $w = $w . "(" . "subcategory_rank <= " . $request->input('maxRank') . ")";
        }

        //get minSales
        if (is_null($request->input('minSales')) == false) {
            if ($w != '') {$w = $w . " AND ";}
            $w = $w . "(" . "sales >= " . $request->input('minSales') . ")";
        }
        //get maxSales
        if (is_null($request->input('maxSales')) == false) {
            if ($w != '') {$w = $w . " AND ";}
            $w = $w . "(" . "sales <= " . $request->input('maxSales') . ")";
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
        //free Courses only
        if (is_null($request->input('FreeCourses')) == false) {
            if ($request->input('FreeCourses') == 'false')
            {
              if ($w != '') {$w = $w . " AND ";}
              $w = $w . "(is_free = 0)";
            }
        }

        return($w);

    }

}
