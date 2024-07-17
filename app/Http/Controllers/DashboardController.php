<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Subscription;
use Auth;
use Braintree_Subscription;
use DateTime;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
  public function getDataStatus(Request $request) {

      $sql = "select DATE_FORMAT(max(created), '%d.%m.%Y') status_date from course";
      $r = DB::select($sql)[0];
      
      //when today is tuesday and the last date is not today => today : next tuesday
      $now = new DateTime;
      $lastLoad = new DateTime($r->status_date);
      $nextLoad = date('d.m.Y', strtotime('next tuesday'));
      if ($now->diff( $lastLoad )->days >= 7 ) {
          $nextLoad = date('d.m.Y', strtotime(now()));
      }
      
      $html = '<ul>';
      $html .= '<li>Course data - last updated - ' . $r->status_date . '</li>';
      $html .= '<li>Course data - next updated - ' . $nextLoad . '</li>';
      $html .= '</ul><hr>';
      
      $html .= '<ul>';
      $sql = "select DATE_FORMAT(max(rank_date), '%d.%m.%Y') status_date from keyword_ranking";
      $r = DB::select($sql)[0];
      $lastLoad = new DateTime($r->status_date);
      $nextLoad = date('d.m.Y', strtotime('next tuesday'));
      if ($now->diff( $lastLoad )->days >= 7 ) {
          $nextLoad = date('d.m.Y', strtotime(now()));
      }
      $html .= '<li>Keyword data - last updated - ' . $r->status_date . '</li>';
      $html .= '<li>Keyword data - next updated - ' . $nextLoad . '</li>';
      $html .= '</ul>';

      echo $html;
  }
  public function getSubStatus(Request $request) {
      $user = Auth::User();
      //$subscription = Subscription::where('user_id', $user->id)->first();
      $subscription = MemberController::currentSubscription($user);
      //dd($subscription)
      if (!$subscription) {
          $txt = ucwords($user->first_name) . ', you are enrolled for the teachinguide "free" subscription.';
          $txt .= '</br></br> If you are looking to get even more insights on competition and opportunities, please upgrade to our "Insight" or "Compete" edition.';
          //$txt .= '</br></br><button id="upgradeButton" class="btn btn-primary">Upgrade</button>';
          if($user->onGenericTrial())
          {
            $ends = $user->trial_ends_at;
            $txt .= '</br></br> Your trial period ends on '. $ends;
          }
          $txt .= '</br></br><div class="row"><div class="col-md-3"><a class="btn btn-primary" href="account" role="button">Upgrade</a></div>';
          $txt .= '<div class="col-md-9"><a class="btn btn-success" href="account?tab=affiliate" role="button" style="margin-left: 5px;">Additional 7 days of free trial</a></div></div>';

          

      } elseif ($subscription->braintree_plan=='tg_free_monthly') {
          $txt = ucwords($user->first_name) . ', you are enrolled for the teachinguide "free" subscription.';
          $txt .= '</br></br> If you are looking to get even more insights on competition and opportunities, please upgrade to our "Insight" or "Compete" edition.';
          //$txt .= '</br></br><button id="upgradeButton" class="btn btn-primary">Upgrade</button>';
          $txt .= '</br></br><a class="btn btn-primary" href="account" role="button">Upgrade</a>';
      } else {
          $sub = Braintree_Subscription::find($subscription->braintree_id);
          $grace = $user->subscription($subscription->name)->onGracePeriod();
          $trial = $user->subscription($subscription->name)->onTrial();
          $sql = "SELECT p.name, p.billing_frequency FROM plans as p INNER JOIN subscriptions as s on s.user_id = " . $user->id . " AND s.braintree_id = '" . $subscription->braintree_id . "' AND p.braintree_plan = '".$subscription->braintree_plan."'";
          //dd($sql);
          $results = DB::select($sql);
          $billing_frequency = $results[0]->billing_frequency;
          $term = 'monthly';
          if ($billing_frequency == 12) {
              $term = 'yearly';
          }
          $txt = ucwords($user->name) . ', you are enrolled for the teachinguide "' . $subscription->name . '" subscription on a "' . $term . '" term.';

          if ($trial) {
            $ends = $subscription->trial_ends_at;
            $txt .= '</br></br> Your trial period ends on '. $ends;
          }
          if ($grace) {
              $ends = $subscription->ends_at;
              $txt .= '</br></br> Unfortunately your subscription ends on ' . $ends . '. You can resume it with one click here.';
              //$txt .= '</br></br><button id="upgradeButton" class="btn btn-primary">Upgrade</button>';
              $txt .= '</br></br><a class="btn btn-primary" href="account" role="button">Resume</a>';
          } else {
              /*if ($sub_sname == 'free' || $sub_sname == 'student') {
                  $txt .= '</br></br> If you are looking to get even more insights on competition and opportunities, please test our "Insight" or "Compete" edition.';
                  //$txt .= '</br></br><button id="upgradeButton" class="btn btn-primary">Upgrade</button>';
                  $txt .= '</br></br><a class="btn btn-primary" href="account" role="button">Upgrade</a>';
              }
              if ($sub_sname == 'insight') {
                  $txt .= '</br></br> If you are looking to get even more insights on competition and opportunities, please test our "Compete" edition.';
                  //$txt .= '</br></br><button id="upgradeButton" class="btn btn-primary" href="/account">Upgrade to Compete</button>';
                  $txt .= '</br></br><a class="btn btn-primary" href="account" role="button">Upgrade to Compete</a>';
              }*/
          }
      }
      echo $txt;
  }
  public function getSparklineStudentsData(Request $request) {
      $sql = "select
                GROUP_CONCAT(a.students ORDER BY a.year, a.week_of_year) group_students
              from
                (SELECT year, week_of_year, students  FROM `course_weekly_summary`) as a";
      $results = DB::select($sql);
      if($results){
          foreach($results as $r){
              $html = $r->group_students;
          }
      }
      echo $html;
  }
  public function getSparklineCourseData(Request $request) {
      $sql = "select
                GROUP_CONCAT(a.courses ORDER BY a.year, a.week_of_year) group_courses
              from
                (SELECT year, week_of_year, courses  FROM `course_weekly_summary`) as a";
        $results = DB::select($sql);
        if($results){
            foreach($results as $r){
                $html = $r->group_courses;
            }
        }
        echo $html;
  }
  public function getSparklineReviewsData(Request $request) {
      $sql = "select
                GROUP_CONCAT(a.reviews ORDER BY a.year, a.week_of_year) group_reviews
              from
                (SELECT year, week_of_year, reviews  FROM `course_weekly_summary`) as a";
      $results = DB::select($sql);
      if($results){
          foreach($results as $r){
              $html = $r->group_reviews;
          }
      }
      echo $html;
  }
  public function getTopSubcategories(Request $request) {
      $sql = "SELECT subcategory FROM `course` group by subcategory order by sum(sales) desc limit 10";
      $results = DB::select($sql);
      $data = array();
      $html = '';
      $i = 1;
      if($results){
          foreach($results as $r){
              $html .= '<tr><td class="no-borders">' . $i . '.</td>';
              $html .= '<td class="no-borders">' . $r->subcategory . '</td></tr>';
              $i = $i + 1;
          }
      }
      echo $html;
  }
  public function getTopCourses(Request $request) {
      $sql = "SELECT title FROM `course`";
      if (is_null($request->input('paid')) == false) {
          if ($request->input('paid') == 0) {
              $sql .= " where is_free=0";
          }
      }
      $sql .=" order by sales desc limit 10";
      $results = DB::select($sql);
      $data = array();
      $html = '';
      $i = 1;
      if($results){
          foreach($results as $r){
              $html .= '<tr><td class="no-borders">' . $i . '.</td>';
              $html .= '<td class="no-borders">' . $r->title . '</td></tr>';
              $i = $i + 1;
          }
      }
      echo $html;
  }
  public function getTopTopics(Request $request) {
      $sql = "SELECT topic FROM `topic` order by sum_new_students desc limit 10";
      $results = DB::select($sql);
      $data = array();
      $html = '';
      $i = 1;
      if($results){
          foreach($results as $r){
              $html .= '<tr><td class="no-borders">' . $i . '.</td>';
              $html .= '<td class="no-borders">' . $r->topic . '</td></tr>';
              $i = $i + 1;
          }
      }
      echo $html;
  }
  public function getTopKeywords(Request $request) {
      $sql = "SELECT keyword FROM `keyword`";
      if (is_null($request->input('paid')) == false) {
          if ($request->input('paid') == 0) {
              $sql .= " where keyword not like '%free%'";
          }
      }
      $sql .=" order by uvolume desc limit 10";
      $results = DB::select($sql);
      $data = array();
      $html = '';
      $i = 1;
      if($results){
          foreach($results as $r){
              $html .= '<tr><td class="no-borders">' . $i . '.</td>';
              $html .= '<td class="no-borders">' . $r->keyword . '</td></tr>';
              $i = $i + 1;
          }
      }
      echo $html;
  }
}
