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
use DateTime;

class CloudCrawlerController extends Controller
{
    public function postCLPJobs(Request $request) {
        $user = User::find(Auth::id());
        $date = new DateTime;
        $date->modify('-5 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $getCourseIds = Monitor_course::with(array('getCourses'=>function($query){
            $query->select('course_id','course_url','last_updated');
        }))
        ->where(function ($query) use ($formatted_date) {
            $query->where('created_at', '>', $formatted_date)
                ->orWhere('updated_at', '<=', $formatted_date);
        })
        ->where('user_id', $user->id)
        ->get();
        
        $assoArray = [];
        $startUrls = [];
        foreach ($getCourseIds as $getList) {
            foreach ($getList->getCourses as $key => $getUrl) {
                $assoArray['id'] = $getUrl->course_id;
                $assoArray['url'] = $getUrl->course_url;
                $startUrls[] = $assoArray;
                $changeStatus = Monitor_course::where('user_id', Auth::id())->where('course_id', $getUrl->course_id)->update([
                    'status' => '1'
                ]);
            }
        }

        if(is_array($startUrls) && sizeof($startUrls)==0)
        {
            echo -1; ////For Show already refreshed.
            exit();
        }

        //$user_id    = env('APIFY_USER_ID');
        //$crawler_id = env('APIFY_CRAWLER_ID');
        //$token      = env('APIFY_TOKEN');
        //$cloudURL   = 'http://localhost:7071/api/HttpPostCLPs';
        $cloudURL   = 'https://tgfncappvs.azurewebsites.net/api/HttpPostCLPs';

        $postData = [
            'app'       => 'tg-api',
            'clps'      => $startUrls,
            'user_id'   => Auth::id()
        ];
        $curl = new cURL;
        $response = $curl->jsonPost($cloudURL, $postData);
        if($response->statusCode==200)
        {
            echo(sizeof($startUrls));
        }
        else
        {
            echo 0;
        }
    }

    public function receiveCLPJobs(Request $request)
    {
        $data = $request->all();

        if (!$request->id) {
            return -1;
        } else {
            //save results/update course data
            \DB::table('course')->where('course_id', $request->id)
            ->update([
                'students'   => str_replace(',', '', $request->enrollments), 
                'reviews'    => $request->reviews, 
                'rating'     => $request->rating,
                'last_updated'=> date('Y-m-d')
            ]);

            ///Update Status monitor_course table
            Monitor_course::where('course_id', $request->id)
            ->update([
                'status' => '0'
            ]); 
        }       
        
    }

    public function checkTableStatus(Request $request)
    {
        $user = User::find(Auth::id());
        $getCourseIds = Monitor_course::where('user_id', Auth::id())->where('status', '1')->count();
        if($getCourseIds>0)
        {
            echo $getCourseIds; // -------
        }
        else
        {
            echo 0; // display message - Course monitor table succssfully refreshed.
        }
        
    }
}
