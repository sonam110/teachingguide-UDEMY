<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Author;
use App\Keyword;
use DB;


class EstimatorController extends Controller
{
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

    public function getCourseEstimate(Request $request) {
        if ($request->input("course_id"))
        {
            $course_id = $request->input('course_id');
            $match = ['course_id' => $course_id];
            $course = Course::where($match)->first();
            $formatted = [
                'id' => $course->course_id, 
                'title' => $course->title,
                'author' => $course->author,
                'price' => $course->price,
                'sales' => $course->sales
            ];
                
            return \Response::json($formatted);
        }
    }

    public function searchInstructor(Request $request) {
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

    public function getInstructorEstimate(Request $request) {
        if ($request->input("instructor_id"))
        {
            $author_id = $request->input('instructor_id');
            $match = ['author_id' => $author_id];
            $author = Author::where($match)->first();
            $formatted = [
                'id' => $author->author_id, 
                'name' => $author->author,
                'sales' => $author->sum_new_students,
                'course_count' => $author->course_anz
            ];
                
            return \Response::json($formatted);
        }
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

    public function getKeywordEstimate(Request $request)
    {
        if ($request->input("keyword_id"))
        {
            $keyword_id = $request->input('keyword_id');
            $raw = "SELECT k.keyword_id, k.keyword, c.title, c.sales, c.author, c.price
                    FROM `keyword` as k 
                    INNER JOIN keyword_ranking as kr on k.keyword_id = kr.keyword_id 
                    INNER JOIN course as c on kr.course_id = c.course_id 
                    WHERE k.keyword_id = " . $keyword_id . " and kr.current=1 and kr.rank=1";
            $result = DB::select($raw)[0];
            $formatted = [
                'id' => $result->keyword_id, 
                'keyword' => $result->keyword,
                'title' => $result->title,
                'author' => $result->author,
                'price' => $result->price,
                'sales' => $result->sales
            ];
                
            return \Response::json($formatted);
        }
    }
}
