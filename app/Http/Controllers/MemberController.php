<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Mail;
use App\Mail\SubChange;
use Notifiable;
use Validator;
use App\Mail\SubMail;
use App\Mail\AdminNote;
use App\Product;
use App\User;
use App\Subscription;
use App\Author;
use App\Topic;
use App\Subcategory;
use App\Coupon;
use App\Discount;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Plan;
use Braintree_Subscription;
use URL;
use Redirect;
use Braintree\Transaction as BraintreeTransaction;
use Braintree\Customer as Braintree_Customer;

class MemberController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  public static function hasCompete(){

    $ctime = Carbon::now()->toDateTimeString();
    $user = Auth()->user();
    $hasGenericTrial = $user->trial_ends_at >= $ctime;
    if ($hasGenericTrial == 1) {
        return 1;
    }

    $subscription = MemberController::currentSubscription($user);

    if (!$subscription) {
        return 0;
    }

    //if ($subscription->stripe_plan == "tg_compete_monthly" || $subscription->stripe_plan == "tg_compete_yearly") {
    $product = Plan::where(['braintree_plan' => $subscription->braintree_plan])->first();


    if ($product->level >= 3)
    {
      if ($subscription->ends_at == null) {
          return 1;
      }

      if ($subscription->ends_at >= $ctime) {
          return 1;
      }
    }
    return 0;

	}

  public static function hasInsight(){

    $ctime = Carbon::now()->toDateTimeString();
    $user = Auth()->user();
    $hasGenericTrial = $user->trial_ends_at >= $ctime;
    if ($hasGenericTrial == 1) {
        return 1;
    }

    $subscription = MemberController::currentSubscription($user);
    if (!$subscription) {
        return 0;
    }
    //if ($subscription->stripe_plan == "tg_insight_monthly" || $subscription->stripe_plan == "tg_insight_yearly") {
    $product = Plan::where(['braintree_plan' => $subscription->braintree_plan])->first();
    if ($product->level >= 2)
    {
      if ($subscription->ends_at == null) {
          return 1;
      }
      if ($subscription->ends_at >= $ctime) {
          return 1;
      }
    }
    return 0;

	}
  public static function hasStudent(){

    $ctime = Carbon::now()->toDateTimeString();
    $user = Auth()->user();
    $hasGenericTrial = $user->trial_ends_at >= $ctime;
    if ($hasGenericTrial == 1) {
        return 1;
    }

    $subscription = MemberController::currentSubscription($user);
    if (!$subscription) {
        return 0;
    }
    //if ($subscription->stripe_plan == "tg_insight_monthly" || $subscription->stripe_plan == "tg_insight_yearly") {
    $product = Plan::where(['braintree_plan' => $subscription->braintree_plan])->first();
    if ($product->level >= 1)
    {
      if ($subscription->ends_at == null) {
        return 1;
      }
      if ($subscription->ends_at >= $ctime) {
          return 1;
      }
    }
    return 0;

	}


  public function admin_credential_rules(array $data)
  {
    $messages = [
      'current-password.required' => 'Please enter current password',
      'password.required' => 'Please enter password',
    ];

    $validator = Validator::make($data, [
      'current_password' => 'required',
      'password' => 'required|same:password',
      'password_confirmation' => 'required|same:password',
    ], $messages);

    return $validator;
  }


  public function home()
  {
    return view('webapp.dashboardHome');
  }

  public static function currentSubscription($user) {
      $ctime = Carbon::now()->toDateTimeString();
      $where = 'user_id=' . $user->id . ' AND (ends_at IS NULL OR ends_at > \'' . $ctime . '\')';
      $subscription = Subscription::whereRaw($where)->first();
      return $subscription;
  }

  public function profile(Request $request)
  {
      $tab = '';
      if($request->tab)
      {
        $tab = $request->tab;
      }
      $user = Auth()->user();
      $products = Plan::orderBy('cost', 'asc')->get();
      $subscribed = false;
      $coupon = $user->coupon;
      //get upgrade coupon if applicable for used coupon
      /*if ($request->input('coupon')) {
          $seedcoupon = Discount::where(['discount_id' => $request->input('coupon')])->first();
          if($seedcoupon && $seedcoupon != '')
          {
            $coupon = $seedcoupon;
          }
      } else {
          $seedcoupon = Discount::where(['discount_id' => $user->coupon])->first();
          if ($seedcoupon && $seedcoupon != '') {
              $coupon = Discount::where(['discount_id' => $seedcoupon->discount_id])->first();
          }
      }*/
      //dd($coupon);
      //get current subscription
      $subscription = $this->currentSubscription($user);
      //dd($subscription);
      $grace = false;
      $subscribed = false;
      if ($subscription) {
        $subscribed = true;
        $sub = Braintree_Subscription::find($subscription->braintree_id);
        $grace = $user->subscription($subscription->name)->onGracePeriod();
        $hascard = '';
      }
      $getCustomerInfo = Braintree_Customer::find($user->braintree_id);
      $invoices = null;
      //$invoices = $user->invoices();
      return view('account', compact('user', 'products', 'sub', 'subscription', 'grace', 'invoices', 'coupon', 'subscribed', 'hascard', 'getCustomerInfo','tab'));
  }

  public function listInvoices(Request $request) {
      $user = Auth()->user();
      /*
      Include pending invoices in the results...
      $invoices = $user->invoicesIncludingPending();
      */

      /*
      this is show only that invoices who's $transaction->status = SETTLED
      */
      $invoices = $user->invoices();

      if (empty($invoices)) {
          return \Response::json([]);
      }

      $totalData = count($invoices);

      $formatted = [];
      foreach ($invoices as $i) {
          $formatted[] = [
            'date' => $i->date()->toFormattedDateString(),
            'total' => $i->total(),
            'download' => '<a href="/invoice/' . $i->id .'">Download</a>'
          ];
      }

      $json_data = array(
          "draw"              => intval($request->input('draw')),
          "recordsTotal"      => intval($totalData),
          "data"              => $formatted
      );

      echo json_encode($json_data);

  }

  public function updateAccount(Request $request)
  {
    //dd($request);
    if ($request->input('password_change'))
    {
        //dd("Changing password");
        $this->changePassword($request);
    }

    if ($request->input('username_change'))
    {
        //dd("Changing Name");
        $this->changeName($request);
    }

    if ($request->input('plan_change'))
    {
        //dd("Changing Plan");
        $this->changePlan($request);
    }

    if ($request->input('plan_cancel'))
    {
        //dd("Cancel Subscription");
        $this->cancelSubscription($request);
    }

    if ($request->input('plan_resume'))
    {
        //dd("Resume Subscription");
        $this->resumeSubscription($request);
    }

  }

  public function changePassword(Request $request)
  {
    if(Auth::Check())
    {
      $request_data = $request->All();
      $validator = $this->admin_credential_rules($request_data);
      if($validator->fails())
      {
        echo json_encode(array("errors" => $validator->getMessageBag()->toArray()));
      }
      else
      {
        $current_password = Auth::User()->password;
        if(Hash::check($request_data['current_password'], $current_password))
        {
          $user_id = Auth::User()->id;
          $obj_user = User::find($user_id);
          $obj_user->password = Hash::make($request_data['password']);;
          $obj_user->save();
          echo "ok";
        }
        else
        {
          $error = array('current_password' => 'Please enter correct current password');
          echo json_encode(array('errors' => $error));
        }
      }
    }
    else
    {

      return redirect()->to('/account');
    }
  }

  public function changeName(Request $request)
  {
    if(Auth::Check())
    {
        $request_data = $request->All();

        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $obj_user->name = $request_data['name'];
        $obj_user->save();
        echo "ok";
    }
    else
    {
      return redirect()->to('/account');
    }
  }

  /**
   * Change the current subscription plan for a new one
   *
   * @param Request $request
   * @return Redirect redirect to dashboard view
   */

   public function billing(Request $request)
   {
      $user = Auth()->user();
      $invoices = $user->invoices();
      dd($invoices);
   }

   public function updateCard(Request $request)
   {
      //dd($request);
      $user = Auth()->user();
      if ($request->payment_method_nonce) {
          try {
            $user->updateCard($request->payment_method_nonce);
          } catch(\Exception $e) {
            $e->getMessage();
            return redirect()->back()->with('error', 'Your card information could not be changed. '. $e->getMessage());
        }
          return redirect()->back()->with('success', 'Your card has been updated successfully.');
      } else {
          return redirect()->back()->with('error', 'Your card information could not be changed.');
      }


   }

  public function changePlan(Request $request)
  {
      $product = Plan::where('braintree_plan', '=' ,$request->productId)->firstOrFail();
      $authUser = Auth()->user();

      //check whether user is subscribed, if not...create new subscriptions
      $subscription = $this->currentSubscription($authUser);
      //dd($subscription);

      if (!$subscription) {
          $ret = $this->createNewSubscription($request, $authUser, $product);
          echo($ret);
          return;
      }
      $old_sub = $subscription->braintree_plan;
      //get current subscription
      //$subscription = Subscription::where('user_id', $authUser->id)->first();
      $newSubName = $product->name;

      $user = User::find($authUser->id);
      $coupon = '';
      //dd($subscription->name);
      $seedcoupon = Discount::where(['discount_id' => $product->braintree_plan])->first();
      if($seedcoupon && $seedcoupon != '' && !empty($user->coupon))
      {
        $coupon = $seedcoupon->upgrade_coupon;
      }
      try {
        $user->subscription($subscription->name)
              ->swap($product->braintree_plan)
              ->applyCoupon($coupon, $user->coupon);
        $subscription->update(['trial_ends_at ' => NULL]);///Comment this line if you don't want to skip trial period.
        $subscription->update(['name' => $newSubName]);
        $user->coupon = $coupon;
        $user->trial_ends_at = NULL;
        $user->save();
      } catch(\Exception $e) {
          $e->getMessage();
          dd($e->getMessage());
      } catch(\InvalidArgumentException $e) {
          $e->getMessage();
          dd($e->getMessage());
      }

      ///////user table plan information update
      if($product->braintree_plan == "tg_student_monthly" || $product->braintree_plan == "tg_student_yearly")
      {
          $user->update(['member' => 1, 'student' => 1, 'insight' => 0, 'compete' => 0]);
      }
      else if($product->braintree_plan == "tg_insight_monthly" || $product->braintree_plan == "tg_insight_yearly")
      {
          $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 0]);
      }
      else if($product->braintree_plan == "tg_compete_monthly" || $product->braintree_plan == "tg_compete_yearly")
      {
          $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 1]);
      }
      else if($product->braintree_plan == "tg_free_monthly")
      {
          $user->update(['member' => 1, 'student' => 0, 'insight' => 0, 'compete' => 0]);
      }
      ///////End user table plan information update

      $user->save();


      //Mail::to($user['email'])->send(new SubChange($user, $subscription));

      //notify myself
      $admin_note = $user['email'] . ' - just changed from "'.$old_sub.'" to "' . $product->braintree_plan . '"';
      //Mail::to('thomas@seidel.info')->send(new adminnote($admin_note));

      echo "ok";
      //return redirect()->intended('dashboard');
  }

  public function createNewSubscription(Request $request, $user, $product) {
    $coupon = '';
    if (!empty($request->couponCode)) {
        $getCoupan = Discount::where('coupon_for', $product->id)->where('used', '1')->first();
        if($getCoupan)
        {
            $coupon = $getCoupan->discount_id;
        }
        else
        {
            $coupon = '';
        }
    }
    try {
      $user->newSubscription($product->name, $product->braintree_plan)
          ->withCoupon($coupon)
          //->trialDays($product->trial_duration) If you want to give trial days, then uncomment it and add comment =  ->skipTrial()
          ->skipTrial()
          ->create($request->payment_method_nonce);
    } catch(\Exception $e) {
      $e->getMessage();
      dd($e->getMessage());
    }

    ///////user table plan information update
    if($product->braintree_plan == "tg_student_monthly" || $product->braintree_plan == "tg_student_yearly")
    {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 0, 'compete' => 0]);
    }
    else if($product->braintree_plan == "tg_insight_monthly" || $product->braintree_plan == "tg_insight_yearly")
    {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 0]);
    }
    else if($product->braintree_plan == "tg_compete_monthly" || $product->braintree_plan == "tg_compete_yearly")
    {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 1]);
    }
    else if($product->braintree_plan == "tg_free_monthly")
    {
        $user->update(['member' => 1, 'student' => 0, 'insight' => 0, 'compete' => 0]);
    }
    ///////End user table plan information update
    $user->trial_ends_at = NULL;
    $user->coupon = $coupon;
    $user->save();

    return 'ok';
  }

  /**
   * Cancel the current subscription for the user logged in
   *
   * @return Redirect redirect to dashboard view
   */
  public function cancelSubscription()
  {

      $authUser = Auth()->user();

      //get current subscription
      $subscription = Subscription::where('user_id', $authUser->id)->first();

      $user = User::find($authUser->id);
      try {
        $user->subscription($subscription->name)->cancel();
      } catch(\Exception $e) {
        $e->getMessage();
        dd($e->getMessage());
      }

      //here we need to set what is the correct member configuration
      $user->update(['member' => 1, 'student' => 0, 'insight' => 0, 'compete' => 0]);

      $user->save();
      echo "ok";
  }

  public function resumeSubscription()
  {
    $authUser = Auth()->user();

    //get current subscription
    $subscription = Subscription::where('user_id', $authUser->id)->first();


    $user = User::find($authUser->id);
    try {
      $user->subscription($subscription->name)->resume();
    } catch(\LogicException $e) {
      $e->getMessage();
      dd($e->getMessage());
    } catch(\Exception $e) {
      $e->getMessage();
      dd($e->getMessage());
    }
    $plan = $subscription->braintree_plan;

    //here we need to set what is the correct member configuration
    if($plan == "tg_student_monthly" || $plan == "tg_student_yearly")
    {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 0, 'compete' => 0]);
    }
    else if ($plan == "tg_insight_monthly" || $plan == "tg_insight_yearly")
    {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 0]);
    }
    else if($plan == "tg_compete_monthly" || $plan == "tg_compete_yearly") {
        $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 1]);
    }
    else if($plan == "tg_free_monthly") {
        $user->update(['member' => 1, 'student' => 0, 'insight' => 0, 'compete' => 0]);
    }
    $user->trial_ends_at = NULL;
    $user->save();
    echo "ok";
  }




  public function courseMonitor()
  {
    return view('webapp.dashboardCourseMonitor');
  }

  public function basicCourseSearch()
  {
      return view('webapp.basicCourseSearch');
  }

  public function searchSubCat(Request $request)
  {
      $filter = 0;
      if (!is_null($request->input('filter'))) {
          $filter = $request->input('filter');
      }

      return view('webapp.subCatSearch', compact('filter'));
  }

  public function courseSearch(Request $request)
  {
      $filter = 0;
      if (!is_null($request->input('filter'))) {
          $filter = $request->input('filter');
      }

      if (is_null($request->input('author_id')) == false) {
          $author = Author::where('author_id', $request->input('author_id'))->first();
          return view('webapp.courseSearch', compact('author', 'filter'));
      } elseif (is_null($request->input('topic_id')) == false) {
          $topic = Topic::where('topic_id', $request->input('topic_id'))->first();
          return view('webapp.courseSearch', compact('topic', 'filter'));
      } elseif (is_null($request->input('subcat_id')) == false) {
          $subcat = Subcategory::where('subcategory_id', $request->input('subcat_id'))->first();
          return view('webapp.courseSearch', compact('subcat', 'filter'));
      }
      return view('webapp.courseSearch', compact('filter'));

  }

  public function topicSearch(Request $request)
  {
      $filter = 0;
      if (!is_null($request->input('filter'))) {
          $filter = $request->input('filter');
      }


      return view('webapp.topicSearch', compact('filter'));
  }
  

  public function authorSearch()
  {
      return view('webapp.authorSearch');
  }

  public function keywordSearch()
  {
      return view('webapp.keywordSearch');
  }

}
