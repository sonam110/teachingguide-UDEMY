<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Cookie;
use Auth;
use Mail;
use Validator;
use Carbon\Carbon;
use App\Mail\SubMail;
use App\Mail\AdminNote;
use App\Product;
use App\User;
use App\Coupon;
use App\Subscription;
use App\Discount;
use App\Plan;
use App\Oldusers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Events\UserRegistered;
use Braintree\Customer as Braintree_Customer;;


class SignUpController extends Controller
{
    use Notifiable;

    private $plans = [

    ];


    public function __construct()
    {

    }

    public function thankyou(Request $request)
    {

        if (Auth::check())
        {
            $product = Plan::where('braintree_plan', $request->sub)->first();
            $user = Auth()->user();
            $signedup = 1;
            return view('thankyou', compact('user', 'product', 'signedup'));
        } else
        {
            return redirect()->to('/');
        }
    }

    public function signup()
    {
        //if user authenticated, redirect to account-page to change subscription there
        if (Auth::check())
        {
            return redirect()->intended('account');
        }

        $products = Plan::orderBy('cost', 'asc')->get();
        $product_id = request()->sub;
        $coupon_id = request()->coupon;
        $discountp = 0;
        if (!empty($coupon_id)) {
            $coupon = $coupon_id;
            $title = 'Top Undemy Instructor Research Tool | Teachinguide Web App';
            $meta = 'Build a scalable Udemy business with one powerful solution. Find niche course topics, track courses for future sales, and get access to accurate enrollment data and competitor data with the Teachinguide Web App!';

            if ($coupon) {
                return view(
                    'signup',
                    compact('products', 'product_id', 'coupon', 'coupon_id', 'title', 'meta')
                );
            }
        }
        //dd($products);
        return view('signup', compact('products', 'product_id'));

    }

    function whatsIncluded(Request $request) {

        if ($request->sub) {
            $product = Plan::find($request->sub);

            $features = explode(',', $product->description);
            $term = $product->billing_frequency;

            $html = '<h2 class="font-bold">Whats included</h2></br>';
            $html .= '<ul class="included-ul">';
            $html .= '<li><i class="fa fa-check green"></i> Try completely risk free with our <strong>7 day free trial</strong>!</li>';
            if ($request->coupon && $product->sub_sname != 'free') {
                $coupon_id = $request->coupon;
                $match = ['coupon' => $coupon_id, 'valid' => 1];
                $coupon = Coupon::where($match)->first();
                $html .= '<li><i class="fa fa-check green"></i> You get an exclusive and timely limited <strong>'.$coupon->percent.'% discount</strong>!</li>';
            }

            if ($term=='1') {
                $html .= '<li><i class="fa fa-check green"></i> A teachinguide community membership on a monthly subscription base.</li>';
            } else {
                $end = date('l jS \of F Y', strtotime('+1 years'));
                $html .= '<li><i class="fa fa-check green"></i> 12 Month Membership (expires on '.$end.').</li>';
            }

            if($features){
                foreach($features as $f){
                    $html .= '<li><i class="fa fa-check"></i> ' . $f . '</li>';
                }
            }
                $html .= '<li><i class="fa fa-check green"></i><strong> 30 Day Money Back Guarantee.</strong></li>';
            if ($product->sub_sname != 'free') {
                $html .= '<li><i class="fa fa-check green"></i> eBook <strong>"5 Ways For Growing Udemy Courses"</strong></li>';
            }
            $html .= '</ul></br>';
            //if ($product->sub_sname != 'free') {
            $html .= '<div class="row">';
            $html .= '<div class="col-md-12" style="margin-bottom:30px;">
                          <img src="/assets/img/offer/5Methods3DCover.png" alt="ebook 5 Ways To Grow Your Udemy Courses Fast" style="width:150px;margin:0 auto;" class="img-responsive center-block">
                     </div>';
            // $html .= '<div class="col-md-6" style="margin-bottom:30px;">
            //               <img src="/assets/img/badges/7-Day-Trial.png" alt="7 Day free trial" style="width:150px;margin:0 auto;" class="img-responsive center-block">
            //          </div>';
             $html .= '</div>';
            //}
            $html .= 'Already have an account? <a class="page-scroll" href="/login">Log in.</a>';

            echo $html;
        }
    }

    public function store(Request $request)
    {

        //dd($request);
        $validatedData = $request->validate([
            'first_name'=> 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        // get the plan after submitting the form
        $plan = Plan::findOrFail($request->plan);
        $planName = $plan->name;
        $braintreePlan = $plan->braintree_plan;
        //$referred_by = Cookie::get('referral');
        $referred_by = $request->cookie('referral');
        if($request->couponCode)
        {
            $coupon = $request->couponCode;
        }
        else
        {
            $coupon = '';
        }
        $trial_ends_at = now()->addDays(7);  ////Change here if you want to increase or decrease trial days.

        /*if (!empty($request->couponCode)) {
            ////used = 1 for new registration and used = 0 for upgrade subscrition
            $getCoupan = Discount::where('coupon_for', $request->plan)->where('used', '1')->first();
            if($getCoupan)
            {
                $coupon = $getCoupan->discount_id;
            }
            else
            {
                $coupon = '';
            }
        }*/
        $checkOldUser = Oldusers::where('email', $request->email)->first();
        if($checkOldUser)
        {
            //$plan = Plan::where('braintree_plan', 'tg_compete_yearly')->first();
            $coupon = 'old_users_free_365_days';
            //$planName = $plan->name;
            //$braintreePlan = $plan->braintree_plan;
            $trial_ends_at = now()->addDays(365);
        }
        $result = Braintree_Customer::create(array(
                'firstName' => $request->first_name,
                'lastName'  => $request->last_name,
                'email'     => $request->email
            ));
        $user = User::create([
              'first_name'      => $request->first_name,
              'last_name'       => $request->last_name,
              'name'            => $request->first_name,
              'email'           => $request->email,
              'password'        => Hash::make($request->password),
              'member'          => 1,
              'coupon'          => $coupon,
              'affiliate_id'    => str_random(10),
              'referred_by'     => $referred_by,
              'trial_ends_at'   => $trial_ends_at,
              'braintree_id'    => $result->customer->id
          ]);

        if(!empty($referred_by))
        {
            $getAffiliatedUser = User::where('affiliate_id', $referred_by)->first();
            $trial_ends_at = $getAffiliatedUser->trial_ends_at;
            if(!empty($getAffiliatedUser->trial_ends_at))
            {
                $fromDate = now()->subDays(7);
                $endDate = now()->addDays(7);
                if ($trial_ends_at < now() && $trial_ends_at > $fromDate) {
                    $getAffiliatedUser->trial_ends_at = date('Y-m-d H:i:s', strtotime($trial_ends_at. '+7 days'));
                    $getAffiliatedUser->save();
                }
                else {
                    /////This is for the old user if the trial_ends_at date is large then endDate then the trial_ends_at field not need to update.
                    if($trial_ends_at < $endDate)
                    {
                        $getAffiliatedUser->trial_ends_at = now()->addDays(7);
                        $getAffiliatedUser->save();
                    }
                }
                
            }
            ////This cookie has been deleted because it is set to forever and if the user signs up through the same system, then it will be reused.
            Cookie::queue(
                Cookie::forget('referral')
            );
        }

        /*try {
        // subscribe the user
            $user->newSubscription($planName, $braintreePlan)
                ->withCoupon($coupon)
                ->trialDays($plan->trial_duration)
                ->create($request->payment_method_nonce);

            event(new UserRegistered($user));
        } catch(\Exception $e) {
            //////Delete user because its not registered in braintree if any exception
            User::where('id', $user->id)->delete();
            $e->getMessage();
            dd($e->getMessage());
        }
        ///////user table plan information update
        if($plan->braintree_plan == "tg_student_monthly" || $plan->braintree_plan == "tg_student_yearly")
        {
            $user->update(['member' => 1, 'student' => 1, 'insight' => 0, 'compete' => 0]);
        }
        else if($plan->braintree_plan == "tg_insight_monthly" || $plan->braintree_plan == "tg_insight_yearly")
        {
            $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 0]);
        }
        else if($plan->braintree_plan == "tg_compete_monthly" || $plan->braintree_plan == "tg_compete_yearly")
        {
            $user->update(['member' => 1, 'student' => 1, 'insight' => 1, 'compete' => 1]);
        }
        else if($plan->braintree_plan == "tg_free_monthly")
        {
            $user->update(['member' => 1, 'student' => 0, 'insight' => 0, 'compete' => 0]);
        }*/
        ///////End user table plan information update


        //Mail::send('mails.confirmation', ['name' => $user['name']], function($message) {
            //$message->to($user['email'], 'teachinguide')->subject('teachinGuide - Subscription Confirmation');
        //});
        ////////Uncomment for mail send
        //Mail::to($user['email'])->send(new SubMail($user));

        //notify myself
        $admin_note = $user['email'] . ' - just signed up for "' . $plan->braintree_plan . '"';
        ////////Uncomment for mail send
        Mail::to('thomas@seidel.info')->send(new adminnote($admin_note));
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $url = "/thank-you?sub=" . $plan->braintree_plan;
            return redirect()->intended($url);
        }

        // redirect to home after a successful subscription
        return redirect()->back();
    }
}
