<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use Auth;
use Mail;
use Validator;
use App\Product;
use App\PaypalProduct;
use App\User;
use App\Coupon;
use App\Subscription;
use App\PaypalHistory;
use Carbon\Carbon;
use App\Mail\SubMail;
use App\Mail\AdminNote;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\Events\UserRegistered;

use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

use Redirect;
// Used to process plans
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;

class PaypalController extends Controller
{
    private $apiContext;
    private $mode;
    private $client_id;
    private $secret;
    
    // Create a new instance with our paypal credentials
    public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if(config('paypal.settings.mode') == 'live'){
            $this->client_id = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        
        // Set the Paypal API Context/Credentials
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->client_id, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function create_paypal_plan()
    {
        $getPlansLists = $this->getPlanList();
        $products = Product::where('active', '1')->get();
        return view('admin.create_paypal_plan', compact('products', 'getPlansLists'));
    }

    public function viewpaypal($billingAgreementId)
    {
      $createdAgreement = $billingAgreementId;
      try {
          $agreement = Agreement::get($createdAgreement, $this->apiContext);
      } catch (Exception $ex) {
          dd($ex);
          exit(1);
      }
      
      //dd($agreement);
      $data = [
        'id' => $agreement->id,
        'description' => $agreement->description,
        'start_date' => $agreement->start_date,
        'plan' => $agreement->plan,
        'vendor'  => 'teachinguide',
        'product' => 'Subscription',
      ];

      $filename = $agreement->id.'.pdf';

        return new \Response($this->pdf($data), 200, [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type' => 'application/pdf',
        ]);
      
    }

    public function pdf(array $data)
    {
        if (! defined('DOMPDF_ENABLE_AUTOLOAD')) {
            define('DOMPDF_ENABLE_AUTOLOAD', false);
        }

        if (file_exists($configPath = base_path().'/vendor/dompdf/dompdf/dompdf_config.inc.php')) {
            require_once $configPath;
        }

        $dompdf = new Dompdf;

        $dompdf->loadHtml($this->view($data)->render());

        $dompdf->render();

        return $dompdf->output();
    }

    public function view(array $data)
    {
        return View::make('admin.invoice', array_merge($data, [
            'invoice' => $data,
            'owner' => Auth::user(),
            'user' => Auth::user(),
        ]));
    }

    public function getPlan($planid)
    {
        try {
		    $plan = Plan::get($planid, $this->apiContext);
		} catch (Exception $ex) {
			dd($ex);
		    exit(1);
		}
		dd($plan);
    }

    public function save_plan(Request $request)
    {
    	$validatedData = $request->validate([
            'productId' => 'required',
            'offer'     => 'required|numeric',
        ]);

        $getPrInfo = Product::find($request->productId);
        $price = round($getPrInfo->sub_price / 100 * (1 - $request->offer/100), 0, PHP_ROUND_HALF_DOWN);
        $save_plan = [
        	'pr_id'			     => $getPrInfo->id,
        	'sub_name'		   => $getPrInfo->sub_name,
        	'sub_sname'		   => $getPrInfo->sub_sname,
        	'sub_interval'   => $getPrInfo->sub_interval,
          'sub_price'      => $getPrInfo->sub_price,
        	'offer'		       => $request->offer,
        	'stripe_id'		   => $getPrInfo->stripe_id,
        	'features'		   => $getPrInfo->features
        ];
        
        \Session::put('savePlan', $save_plan);
        

    	// Create a new billing plan
		$plan = new Plan();
		$plan->setName($getPrInfo->sub_name)
		  ->setDescription(substr($getPrInfo->features,0,100))
		  ->setType('fixed');

		// Set billing plan definitions
    $pd = array();
    $paymentDefinition = new PaymentDefinition();
    $paymentDefinition->setName('1st Week Free')
        ->setType('TRIAL')
        ->setFrequency('Week')
        ->setFrequencyInterval('1')
        ->setCycles('1')
        ->setAmount(new Currency(array('value' => 0, 'currency' => 'USD')));
    $pd[] = $paymentDefinition;
    $paymentDefinition = new PaymentDefinition();
		if($getPrInfo->sub_interval=='monthly')
		{
			$paymentDefinition->setName('Regular Payments')
			  ->setType('REGULAR')
			  ->setFrequency('Month')
			  ->setFrequencyInterval('1')
			  ->setCycles('1')
			  ->setAmount(new Currency(array('value' => $price, 'currency' => 'USD')));
		  $pd[] = $paymentDefinition;
    }
		else
		{
			$paymentDefinition->setName('Regular Payments')
			  ->setType('REGULAR')
			  ->setFrequency('Month')
			  ->setFrequencyInterval('1')
			  ->setCycles('12')
			  ->setAmount(new Currency(array('value' => $price, 'currency' => 'USD')));
		  $pd[] = $paymentDefinition;
    }

    

		// Set merchant preferences
		$merchantPreferences = new MerchantPreferences();
		$merchantPreferences->setReturnUrl(url('/paypal/return'))
		  ->setCancelUrl(url('/paypal/return'))
		  ->setAutoBillAmount('yes')
		  ->setInitialFailAmountAction('CONTINUE')
		  ->setMaxFailAttempts('3')
		  ->setSetupFee(new Currency(array('value' => 0, 'currency' => 'USD')));

		$plan->setPaymentDefinitions($pd);
		$plan->setMerchantPreferences($merchantPreferences);
		//create the plan
        try {
            $createdPlan = $plan->create($this->apiContext);
            try {
                $patch = new Patch();
                $value = new PayPalModel('{"state":"ACTIVE"}');
                $patch->setOp('replace')
                  ->setPath('/')
                  ->setValue($value);
                $patchRequest = new PatchRequest();
                $patchRequest->addPatch($patch);
                $createdPlan->update($patchRequest, $this->apiContext);
                $plan = Plan::get($createdPlan->getId(), $this->apiContext);

                // Output plan id
                if(!empty($plan->getId()))
                {
                	$savePlan = \Session::get('savePlan');
                	\Session::forget('savePlan');
                	$plancreate = PaypalProduct::Create($savePlan);
                	$planid = PaypalProduct::where('id', $plancreate->id)->update(['plan_id' => $plan->getId()]);
                }
                return Redirect::back()->with('success', 'Plan created.');
            } catch (PayPal\Exception\PayPalConnectionException $ex) {
                echo $ex->getCode();
                echo $ex->getData();
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }
    }

    public function getPlanList()
    {
    	try {
		    $params = array('page_size' => '2','total_required'=>'yes');
		    $planList = PaypalProduct::all();
		} catch (Exception $ex) {
		    dd($ex);
		    exit(1);
		}
		return $planList;
    }


    public function paypalRedirect()
    {
        $plan_id = \Session::get('plan_id');
        // Create new agreement
        $agreement = new Agreement();
        $agreement->setName('App Name Monthly Subscription Agreement')
          ->setDescription('Basic Subscription')
          ->setStartDate(\Carbon\Carbon::now()->addMinutes(5)->toIso8601String());

        // Set plan id
        $plan = new Plan();
        $plan->setId($plan_id);
        $agreement->setPlan($plan);

        // Add payer type
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);

        try {
          // Create agreement
          $agreement = $agreement->create($this->apiContext);

          // Extract approval URL to redirect user
          $approvalUrl = $agreement->getApprovalLink();

          return redirect($approvalUrl);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
          echo $ex->getCode();
          echo $ex->getData();
          die($ex);
        } catch (Exception $ex) {
          die($ex);
        }

    }

    public function paypalReturn(Request $request)
    {
        $token = $request->token;
        $agreement = new \PayPal\Api\Agreement();

        try {
            // Execute agreement
            $result = $agreement->execute($token, $this->apiContext);

            $userInfo = \Session::get('userInfo');
            $pr_stripe_id = \Session::get('pr_stripe_id');
            $loginSession = \Session::get('loginSession');
            $paidAmount = \Session::get('paidAmount');
            $plan_id = \Session::get('plan_id');
            \Session::forget('userInfo');
            \Session::forget('pr_stripe_id');
            \Session::forget('loginSession');
            \Session::forget('paidAmount');
            \Session::forget('plan_id');
            if(count(Subscription::where('paypal_id', $result->id)->first())<1)
            {
                $user = User::create($userInfo);

                if(isset($result->id)){
                    $user->paypal_id = $result->id;
                    $user->update(['paypal_id' => $result->id]);
                }

                $product = Product::where('stripe_id', $pr_stripe_id)->first();
                /////////Create Subscription
              Subscription::Create([
                  'user_id'       => $user->id,
                  'name'          => $product->sub_name,
                  'paypal_id'     => $result->id,
                  'plan_id'       => $plan_id,
                  'stripe_plan'   => $product->stripe_id,
                  'quantity'      => 1,
                  'trial_ends_at' => date('Y-m-d H:i:s', strtotime('+7 days')),
                  'ends_at'       => date('Y-m-d H:i:s',strtotime('+30 days',strtotime($result->agreement_details->final_payment_date))) . PHP_EOL,
                ]);
              ////////////Paypal History
              $pay = PaypalHistory::create([
                'user_id'     => $user->id,
                'paypal_id'   => $result->id,
                'plan_id'     => $plan_id,
                'amount'      => $paidAmount,
                'stripe_plan' => $pr_stripe_id,
              ]);

              
              ////////Uncomment for mail send
              //Mail::to($user['email'])->send(new SubMail($user));

              //notify myself
              $admin_note = $user['email'] . ' - just signed up for "' . $pr_stripe_id . '"';
              ////////Uncomment for mail send
              //Mail::to('thomas@seidel.info')->send(new adminnote($admin_note));
        }
          if (Auth::attempt($loginSession)) {
              // Authentication passed...
              $url = "/thank-you?sub=" . $pr_stripe_id;
              return redirect()->intended($url);
          }

        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return Redirect::back()->with('error','You have either cancelled the request or your session has expired');
        }
        return Redirect::back()->with('error','You have either cancelled the request or your session has expired');
    }


    
}