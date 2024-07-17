<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ApifyNotification;
use App\User;
use App\Course;
use App\Monitor_course;
use Auth;
use anlutro\cURL\cURL;
use Log;

class ApifyController extends Controller
{
    public function apifyWebhook(Request $request)
    {
        $user = User::find(Auth::id());
        $getCourseIds = Monitor_course::with(array('getCourses'=>function($query){
            $query->select('course_id','course_url','last_updated');
        }))
        ->where('user_id', $user->id)
        ->where('user_id', $user->id)
        ->get();
        
        $assoArray = [];
        $startUrls = [];
        $arrCourseIds = [];
        foreach ($getCourseIds as $getList) {
            foreach ($getList->getCourses as $key => $getUrl) {
                if($getUrl->last_updated<date('Y-m-d'))
                {
                    $assoArray['key'] = 'START';
                    $assoArray['value'] = $getUrl->course_url;
                    $startUrls[] = $assoArray;
                    $arrCourseIds[] = $getUrl->course_id;
                    $changeStatus = Monitor_course::where('user_id', Auth::id())->where('course_id', $getUrl->course_id)->update([
                        'status' => '1'
                    ]);
                }
            }
        }
        
        if(is_array($arrCourseIds) && sizeof($arrCourseIds)==0)
        {
            echo '2'; ////For Show already refreshed.
            exit();
        }
        
        $arrayCIs = implode(",",$arrCourseIds);
        $user_id    = env('APIFY_USER_ID');
        $crawler_id = env('APIFY_CRAWLER_ID');
        $token      = env('APIFY_TOKEN');
        $apifyUrl = "https://api.apify.com/v1/".$user_id."/crawlers/".$crawler_id."/execute?token=".$token;

        $postData = [
            'customId'      => 'My_crawler',
            'startUrls'     => $startUrls,
            'customData'    => $arrayCIs
        ];
        $curl = new cURL;
        $response = $curl->jsonPost($apifyUrl, $postData);
        if($response->statusCode==201)
        {
            echo '1';
        }
        else
        {
            echo '0';
        }
    }

    public function apifyReceiver(Request $request)
    {
        $assoArray = [];
        $startUrls = [];
        $apifyUrl = "https://api.apify.com/v1/execs/".$request->_id."/results";
        $curl = new cURL;
        $response = $curl->get($apifyUrl);
        if($response->statusCode==200)
        {
            $recData = json_decode($response->body, true);
            if(is_array($recData) && sizeof($recData)>0)
            {
                foreach ($recData as $key => $value) 
                {
                  $getCourses = Course::select('course_id')->where('course_url', $value['loadedUrl'])->get();
                  //Log::info($value['loadedUrl']); 
                  foreach ($getCourses as $updateCourse) 
                  {
                        $update = Course::where('course_id', $updateCourse->course_id)->first();
                        if(is_array($value['pageFunctionResult']) && sizeof($value['pageFunctionResult'])>0)
                        {
                            foreach ($value['pageFunctionResult'] as $pageFunctionResult) 
                            {
                                $students   = $update->students;
                                $reviews    = $update->reviews;
                                $rating     = $update->rating;
                                if(!empty($value['pageFunctionResult'][0]['students']))
                                {
                                    $students = $value['pageFunctionResult'][0]['students'];
                                }
                                if(!empty($pageFunctionResult['aggregateRating']['reviewCount']))
                                {
                                    $reviews = $pageFunctionResult['aggregateRating']['reviewCount'];
                                }
                                if(!empty($pageFunctionResult['aggregateRating']['ratingValue']))
                                {
                                    $rating = $pageFunctionResult['aggregateRating']['ratingValue'];
                                }
                                \DB::table('course')->where('course_id', $updateCourse->course_id)
                                ->update([
                                   'students'   => str_replace(',', '', $students), 
                                   'reviews'    => $reviews, 
                                   'rating'     => $rating,
                                   'last_updated'=> date('Y-m-d')
                                ]);

                                ///Update Status monitor_course table
                                Monitor_course::where('course_id', $updateCourse->course_id)
                                ->update([
                                    'status' => '0'
                                ]); 
                            }
                        }
                        else
                        {
                            $assoArray['key'] = 'START';
                            $assoArray['value'] = $value['loadedUrl'];
                            $startUrls[] = $assoArray;
                        }
                    }
                    if(is_array($startUrls) && sizeof($startUrls)>0)
                    {
                        $this->reExecuteCrawler($startUrls);
                    }
                }
                $data = array(
                    'message'   => 'webhook worked With Execution ID:'.$request->_id
                );
                //Log::info($data); 
                return response()->json($data, 200);
            }
            else
            {
                $data = array(
                    'message'   => 'Error'
                  );
                return response()->json($data, 403); 
            } 
        }
        $data = array(
            'message'   => 'Error'
          );
        return response()->json($data, 403); 
    }

    public function reExecuteCrawler($startUrls)
    {
        Log::info($startUrls); 
        $user_id    = env('APIFY_USER_ID');
        $crawler_id = env('APIFY_CRAWLER_ID');
        $token      = env('APIFY_TOKEN');
        $apifyUrl = "https://api.apify.com/v1/".$user_id."/crawlers/".$crawler_id."/execute?token=".$token."&wait=30";
        $postData = [
            'customId'      => 'My_crawler',
            'startUrls'     => $startUrls
        ];
        $curl = new cURL;
        $response = $curl->jsonPost($apifyUrl, $postData);
        $data = array(
            'message'   => 're-execute crawler'
          );
        return response()->json($data, 200);
    }

    public function checkTableStatus(Request $request)
    {
        $user = User::find(Auth::id());
        $getCourseIds = Monitor_course::where('user_id', Auth::id())->where('status', '1')->count();
        if($getCourseIds>0)
        {
            echo '1'; // -------
        }
        else
        {
            echo '0'; // display message - Course monitor table succssfully refreshed.
        }
        
    }
}
