@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/paymentdetails.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading" style="margin-bottom: 20px;">
    <div class="col-lg-12">
        <h2>My Account</h2>
    </div>
</div>

<!-- <div id="PaymentDetails-main" class="modal fade in">
    <div id="PaymentDetails-div">
        <div class="ibox" id="ibox9">
            <div class="ibox-content">
            <div>
                <h2>Please provide your payment details!</h2>
                <section>
                  <div id="cc-section">
                      <div class="row">
                          <div class="col-lg-12" style="margin-bottom: 10px;">
                              <label for="card-element">
                                Credit card
                              </label>
                              <div id="card-element">
                              </div>

                              <div id="card-errors" role="alert"></div>
                          </div>
                      </div>
                      <div class="row">
                            <div class="col-md-3" style="font-size: 22px;">
                                <i class="card-icon fa fa-cc-mastercard"></i>
                                <i class="card-icon fa fa-cc-discover"></i>
                                <i class="card-icon fa fa-cc-visa"></i>
                                <i class="card-icon fa fa-cc-amex"></i>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-lock"></i><span style="font-size: 12px;"> this is a secure 128-bit ssl encrypted payment</span>
                            </div>
                            <div class="col-md-3">
                                <img class="pull-right" src="{{ asset('assets/img/stripe/Stripe Badges/Solid Dark/powered_by_stripe.png')}}" alt="Powered by Stripe">
                            </div>
                      </div>
                  </div>
                </section>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="btnCancelPaymentDetails" class="btn btn-default" data-dismiss="modal" type="cancel" value="Cancel" style="float: left; width: 100px;">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <input id="btnPaymentDetailsSubmit" class="btn btn-primary" type="submit" value="Submit" style="float: right; width: 100px;">
                  </div>
                </div>
            </div>
      </div>
        </div>
    </div>
</div> -->

<div class="tabs-container account-tab">
    <ul id="myTab" class="nav nav-tabs">
        <li class="@if(!$tab) active @endif pull-right"><a data-toggle="tab" href="#tab-1">Member Account</a></li>
        <li class="@if($tab) active @endif pull-right" id><a data-toggle="tab" href="#tab-2">Affiliate Account</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane @if(!$tab) active @endif">

            <div class="row wrapper">
                <div class="col-md-4">
                  <div class="ibox float-e-margins">
                      <h3>Account Profile</h3>
                      This is the information surrounding your profile
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="ibox float-e-margins" id="ibox1">
                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div>
                            <form name="chgName" id="chgName" action="{{route('updateAccount')}}" method="POST">
                              @csrf
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        </br>
                                        <input id="name" placeholder="Username" type="text" class="form-control required" name="name" value="{{ $user->name }}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label></label>
                                    </br>
                                      <button class="btn btn-primary btn-block" type="submit" name="username_change" id="submit_name_btn" ><strong>Change Username</strong></button>
                                  </div>
                                </div>
                            </form>
                        </div>
                  </div>
                </div>
            </div>

            <div class="row wrapper">
                <div class="col-md-4">
                  <div class="ibox float-e-margins">
                      <h3>Change Password</h3>
                      Your password must be at least 8 characters long and include a number.
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="ibox float-e-margins" id="ibox2">
                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div>
                            <form name="chgPass" id="chgPass" action="{{ route('updateAccount') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        </br>
                                        <input type="password" id="current_password" name="current_password" placeholder="********" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password</label>
                                        </br>
                                        <input type="password" id="password" name = "password" placeholder="********" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="form-group">
                                        <label>New Password Confirmation</label>
                                        </br>
                                        <input type="password" id="password_confirmation" name = "password_confirmation" placeholder="********" class="form-control">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label></label>
                                    </br>
                                      <button class="btn btn-primary btn-block" type="submit" name="password_change" id="submit_pass_btn" value="Change Password"><strong>Change Password</strong></button>
                                  </div>
                                </div>
                            </form>
                        </div>
                  </div>
                </div>
            </div>

            <div class="row wrapper">
                <div class="col-md-4">
                  <div class="ibox float-e-margins">
                      <h3>Subscription Information</h3>
                      Update your subscription and view your past and upcoming invoices.
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="ibox float-e-margins" id="ibox3">
                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div>
                            <form  name="chgPlan" id="chgPlan" action="{{ route('updateAccount') }}" method="POST">
                                @csrf


                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Subscription Plan</label> (select to change)
                                        </br>

                                        <select id="selSubscription" name="productId" data-placeholder="Subscription" class="form-control m-b" {{ $grace ? ' disabled' : '' }}>

                                           @if (!empty($coupon))
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->braintree_plan }}"
                                                    @if ($subscribed && $subscription->braintree_plan == $product->braintree_plan)
                                                          selected
                                                    @endif
                                                    >{{$product->name}} - {{round($product->cost / $product->billing_frequency * (1 - 50/100), 0, PHP_ROUND_HALF_DOWN)}} USD per month
                                                  </option>
                                                @endforeach
                                            @else
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->braintree_plan }}"
                                                    @if ($subscribed && $subscription->braintree_plan == $product->braintree_plan)
                                                          selected
                                                    @endif
                                                    >{{$product->name}} - {{$product->cost / $product->billing_frequency}} USD per month
                                                  </option>
                                                @endforeach
                                            @endif


                                        </select>
                                        <input type="hidden" id="currentPlan" name="currentPlan" value="{{ $subscribed ? $subscription->braintree_plan : '' }}" />

                                        @if (!empty($coupon))
                                        <input type="hidden" class="form-control" id="couponCode" name="couponCode" placeholder="Valid Coupon Code" data-stripe="coupon" value="{{$coupon}}">
                                        @else
                                        <input type="hidden" class="form-control" id="couponCode" name="couponCode" placeholder="Valid Coupon Code" data-stripe="coupon" value="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group trial-end-on">
                                        @if ($subscribed)
                                            @if($sub)

                                              @if ($grace)
                                                  <label>Subscriptions ends on</label>
                                                  </br>
                                                  {{ $sub->billingPeriodEndDate->format('Y/m/d') }}
                                              @else
                                                  <label>Next Invoice Date</label>
                                                  </br>
                                                  {{ $sub->nextBillingDate->format('Y/m/d') }}

                                              @endif


                                            @endif
                                        @endif
                                        @if($user->onGenericTrial())
                                          <label>Trial ends on</label>
                                          </br>
                                          {{ date('Y/m/d', strtotime($user->trial_ends_at)) }}
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div>
                                      <div class="payment">
                                        
                                  @if(sizeof($getCustomerInfo->paymentMethods)<1)
                                    <div class="col-md-12">
                                      <strong class="text-danger">
                                        Please update your payment method before subscribe any plan.
                                      </strong>
                                    </div>
                                  @endif
                                  <div class="col-md-6">
                                    <div class="form-group">
                                    <label></label>
                                    </br>
                                      @if ($grace)
                                      <button class="btn btn-primary btn-block" id="submit_resume_btn" name="plan_resume" type="submit"><strong>Resume Subscription</strong></button>
                                      @else
                                      <button class="btn btn-primary btn-block" id="submit_plan_btn" name="plan_change" type="submit" disabled @if(sizeof($getCustomerInfo->paymentMethods)<1) disabled @endif><strong>Change Subscription</strong></button>
                                      @endif
                                  </div>
                                  
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label></label>
                                      </br>
                                      @if (!$grace && $subscribed)
                                        <button class="btn btn-outline btn-danger btn-block" id="cancel-plan" name="plan_cancel" type="button"><strong>Cancel Subscription</strong></button>
                                      @endif
                                  </div>
                                </div>
                                
                                      </div>
                                    </div>
                                  </div>


                            </form>
                        </div>
                  </div>
                </div>
            </div>

            <div class="row wrapper">
                <div class="col-md-4">
                  <div class="ibox">
                      <h3>Update Card</h3>
                      Please provide your payment details!<br>
                      @if(sizeof($getCustomerInfo->paymentMethods)<1)
                        <strong class="text-danger">
                          Please update your payment method before subscribe any plan.
                        </strong>
                      @endif
                      @if(!empty($getCustomerInfo->paypalAccounts))
                      <div class="payment-card">
                        <div class="visaLogo">
                          Paypal
                        </div>
                        <div class="chipLogo">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 230 384.4 300.4" width="38" height="70">
                            <path d="M377.2 266.8c0 27.2-22.4 49.6-49.6 49.6H56.4c-27.2 0-49.6-22.4-49.6-49.6V107.6C6.8 80.4 29.2 58 56.4 58H328c27.2 0 49.6 22.4 49.6 49.6v159.2h-.4z" data-original="#FFD66E" data-old_color="#00FF0C" fill="rgb(237,237,237)"/>
                            <path d="M327.6 51.2H56.4C25.2 51.2 0 76.8 0 107.6v158.8c0 31.2 25.2 56.8 56.4 56.8H328c31.2 0 56.4-25.2 56.4-56.4V107.6c-.4-30.8-25.6-56.4-56.8-56.4zm-104 86.8c.4 1.2.4 2 .8 2.4 0 0 0 .4.4.4.4.8.8 1.2 1.6 1.6 14 10.8 22.4 27.2 22.4 44.8s-8 34-22.4 44.8l-.4.4-1.2 1.2c0 .4-.4.4-.4.8-.4.4-.4.8-.8 1.6v74h-62.8v-73.2-.8c0-.8-.4-1.2-.4-1.6 0 0 0-.4-.4-.4-.4-.8-.8-1.2-1.6-1.6-14-10.8-22.4-27.2-22.4-44.8s8-34 22.4-44.8l1.6-1.6s0-.4.4-.4c.4-.4.4-1.2.4-1.6V64.8h62.8v72.4c-.4 0 0 .4 0 .8zm147.2 77.6H255.6c4-8.8 6-18.4 6-28.4 0-9.6-2-18.8-5.6-27.2h114.4v55.6h.4zM13.2 160H128c-3.6 8.4-5.6 17.6-5.6 27.2 0 10 2 19.6 6 28.4H13.2V160zm43.2-95.2h90.8V134c-4.4 4-8.4 8-12 12.8h-122V108c0-24 19.2-43.2 43.2-43.2zm-43.2 202v-37.6H136c3.2 4 6.8 8 10.8 11.6V310H56.4c-24-.4-43.2-19.6-43.2-43.2zm314.4 42.8h-90.8v-69.2c4-3.6 7.6-7.2 10.8-11.6h122.8v37.6c.4 24-18.8 43.2-42.8 43.2zm43.2-162.8h-122c-3.2-4.8-7.2-8.8-12-12.8V64.8h90.8c23.6 0 42.8 19.2 42.8 42.8v39.2h.4z" data-original="#005F75" class="active-path" data-old_color="#005F75" fill="rgba(0,0,0,.4)"/>
                          </svg>
                        </div>
                        <ul class="ccList">
                          <li>{{$getCustomerInfo->paypalAccounts[0]->email}}</li>
                        </ul>
                        <h4 class="year"> xx/xxxx  </h4>
                      </div>
                      @elseif(!empty($getCustomerInfo->creditCards))
                      <div class="payment-card">
                        <div class="visaLogo">
                          {{$getCustomerInfo->creditCards[0]->cardType}}
                        </div>
                        <div class="chipLogo">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 230 384.4 300.4" width="38" height="70">
                            <path d="M377.2 266.8c0 27.2-22.4 49.6-49.6 49.6H56.4c-27.2 0-49.6-22.4-49.6-49.6V107.6C6.8 80.4 29.2 58 56.4 58H328c27.2 0 49.6 22.4 49.6 49.6v159.2h-.4z" data-original="#FFD66E" data-old_color="#00FF0C" fill="rgb(237,237,237)"/>
                            <path d="M327.6 51.2H56.4C25.2 51.2 0 76.8 0 107.6v158.8c0 31.2 25.2 56.8 56.4 56.8H328c31.2 0 56.4-25.2 56.4-56.4V107.6c-.4-30.8-25.6-56.4-56.8-56.4zm-104 86.8c.4 1.2.4 2 .8 2.4 0 0 0 .4.4.4.4.8.8 1.2 1.6 1.6 14 10.8 22.4 27.2 22.4 44.8s-8 34-22.4 44.8l-.4.4-1.2 1.2c0 .4-.4.4-.4.8-.4.4-.4.8-.8 1.6v74h-62.8v-73.2-.8c0-.8-.4-1.2-.4-1.6 0 0 0-.4-.4-.4-.4-.8-.8-1.2-1.6-1.6-14-10.8-22.4-27.2-22.4-44.8s8-34 22.4-44.8l1.6-1.6s0-.4.4-.4c.4-.4.4-1.2.4-1.6V64.8h62.8v72.4c-.4 0 0 .4 0 .8zm147.2 77.6H255.6c4-8.8 6-18.4 6-28.4 0-9.6-2-18.8-5.6-27.2h114.4v55.6h.4zM13.2 160H128c-3.6 8.4-5.6 17.6-5.6 27.2 0 10 2 19.6 6 28.4H13.2V160zm43.2-95.2h90.8V134c-4.4 4-8.4 8-12 12.8h-122V108c0-24 19.2-43.2 43.2-43.2zm-43.2 202v-37.6H136c3.2 4 6.8 8 10.8 11.6V310H56.4c-24-.4-43.2-19.6-43.2-43.2zm314.4 42.8h-90.8v-69.2c4-3.6 7.6-7.2 10.8-11.6h122.8v37.6c.4 24-18.8 43.2-42.8 43.2zm43.2-162.8h-122c-3.2-4.8-7.2-8.8-12-12.8V64.8h90.8c23.6 0 42.8 19.2 42.8 42.8v39.2h.4z" data-original="#005F75" class="active-path" data-old_color="#005F75" fill="rgba(0,0,0,.4)"/>
                          </svg>
                        </div>
                        <ul class="ccList">
                          <li>{{$getCustomerInfo->creditCards[0]->maskedNumber}} </li>
                        </ul>
                        <h4 class="name"> {{$getCustomerInfo->creditCards[0]->cardholderName}}</h4>
                        <h4 class="year"> {{$getCustomerInfo->creditCards[0]->expirationDate}}  </h4>
                      </div>
                      @else
                      <div class="payment-card">
                        <div class="visaLogo">
                          No Payment Information
                        </div>
                        <div class="chipLogo">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 230 384.4 300.4" width="38" height="70">
                            <path d="M377.2 266.8c0 27.2-22.4 49.6-49.6 49.6H56.4c-27.2 0-49.6-22.4-49.6-49.6V107.6C6.8 80.4 29.2 58 56.4 58H328c27.2 0 49.6 22.4 49.6 49.6v159.2h-.4z" data-original="#FFD66E" data-old_color="#00FF0C" fill="rgb(237,237,237)"/>
                            <path d="M327.6 51.2H56.4C25.2 51.2 0 76.8 0 107.6v158.8c0 31.2 25.2 56.8 56.4 56.8H328c31.2 0 56.4-25.2 56.4-56.4V107.6c-.4-30.8-25.6-56.4-56.8-56.4zm-104 86.8c.4 1.2.4 2 .8 2.4 0 0 0 .4.4.4.4.8.8 1.2 1.6 1.6 14 10.8 22.4 27.2 22.4 44.8s-8 34-22.4 44.8l-.4.4-1.2 1.2c0 .4-.4.4-.4.8-.4.4-.4.8-.8 1.6v74h-62.8v-73.2-.8c0-.8-.4-1.2-.4-1.6 0 0 0-.4-.4-.4-.4-.8-.8-1.2-1.6-1.6-14-10.8-22.4-27.2-22.4-44.8s8-34 22.4-44.8l1.6-1.6s0-.4.4-.4c.4-.4.4-1.2.4-1.6V64.8h62.8v72.4c-.4 0 0 .4 0 .8zm147.2 77.6H255.6c4-8.8 6-18.4 6-28.4 0-9.6-2-18.8-5.6-27.2h114.4v55.6h.4zM13.2 160H128c-3.6 8.4-5.6 17.6-5.6 27.2 0 10 2 19.6 6 28.4H13.2V160zm43.2-95.2h90.8V134c-4.4 4-8.4 8-12 12.8h-122V108c0-24 19.2-43.2 43.2-43.2zm-43.2 202v-37.6H136c3.2 4 6.8 8 10.8 11.6V310H56.4c-24-.4-43.2-19.6-43.2-43.2zm314.4 42.8h-90.8v-69.2c4-3.6 7.6-7.2 10.8-11.6h122.8v37.6c.4 24-18.8 43.2-42.8 43.2zm43.2-162.8h-122c-3.2-4.8-7.2-8.8-12-12.8V64.8h90.8c23.6 0 42.8 19.2 42.8 42.8v39.2h.4z" data-original="#005F75" class="active-path" data-old_color="#005F75" fill="rgba(0,0,0,.4)"/>
                          </svg>
                        </div>
                        <ul class="ccList">
                          <li>XXXX XXXX XXXX XXXX </li>
                        </ul>
                        <h4 class="name"> No Information Found</h4>
                        <h4 class="year"> XX/XXXX </h4>
                      </div>
                      @endif

                  </div>
                </div>

                <div class="col-md-8">
                  <div class="ibox float-e-margins" id="ibox9">
                        <div class="ibox-content">
                            <div class="sk-spinner sk-spinner-double-bounce">
                                <div class="sk-double-bounce1"></div>
                                <div class="sk-double-bounce2"></div>
                            </div>
                            <form name="updateCard" id="updateCard" action="{{ route('updateCard') }}" method="GET">
                                @csrf
                                <div class="col-md-12">
                                  <div id="dropin-container"></div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <input id="btnPaymentDetailsSubmit" class="btn btn-primary btn-block btn-flat hidden" type="submit" value="Submit">
                                  </div>
                                </div>

                                <div class="col-md-12">
                                  <div class="row">
                                  <div class="col-md-5" style="font-size: 22px;">
                                      <i class="card-icon fa fa-cc-mastercard"></i>
                                      <i class="card-icon fa fa-cc-discover"></i>
                                      <i class="card-icon fa fa-cc-visa"></i>
                                      <i class="card-icon fa fa-cc-amex"></i>
                                  </div>
                                  <div class="col-md-7">
                                      <span class="pull-right">
                                        <i class="fa fa-lock"></i><span style="font-size: 12px;"> this is a secure 128-bit ssl encrypted payment</span>
                                      </span>
                                  </div>
                                </div>
                                </div>

                            </form>


                        </div>
                  </div>
                </div>



            </div>

            <div class="row wrapper">
                <div class="col-md-4">
                  <div class="ibox">
                      <h3>Invoices</h3>
                      View and download your current and pending invoices.
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="ibox" id="ibox4">
                      <div class="ibox-title">
                          <button id="loadInvoices" href="#" class="btn btn-primary">Load Invoices</button>
                      </div>
                      <div class="ibox-content invoice-content-box">
                          <table class="table" id="invoices" class="display">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Download</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-pane @if($tab) active @endif">
            <div class="row wrapper">
                <div class="col-md-6">
                    <div class="ibox float-e-margins" id="ibox1">
                        <div class="ibox-content">
                          <div class="form-group">
                              <label>Welcome to Our Affiliate Program</label>
                              <p>
                                In our affiliate program, you will be supplied with an affiliate link (on the right side) you can use on your website or in your emails.
                                When a user clicks on one of your links, they will be brought to our website and their activity will be tracked by us.
                                You will earn a commission if they purchase one of our services.
                              </p>
                          </div>
                          <div class="form-group">
                              <label>Program Details</label>
                              <p>
                                You get 100% of the first month of any teachinguide subscription sale you deliver.
                                For affiliates generating high-quality traffic, we have higher commissions tiers available and you will be contacted individually.
                              </p>
                              <p>
                                $200.00 USD - Minimum balance required for payout.
                              </p>
                              <p>
                                Payments are made on the last day of each month for commissions that have aged past 30 days. No commissions are paid out until the 30 day month back period has expired.
                              </p>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ibox float-e-margins" id="ibox1">
                        <div class="ibox-content">
                            <div class="form-group">
                                @if(Auth::user()->affiliate_id)
                                <label>Your Affiliate Link</label>
                                <div class="input-group add-on">
                                    <input id="affiliateLink" type="text" class="form-control" readonly="readonly" value="{{url('/').'/?utm_source=affiliate&utm_medium='.Auth::user()->affiliate_id}}">
                                    <div class="input-group-btn">
                                        <button id="copyAffiliateLink" class="btn btn-default grey"><i class="fa fa-copy"></i></button>
                                    </div>
                                </div>
                                @if(!empty($user->trial_ends_at))
                                <div class="text-center">
                                  <strong class="text-danger">Bring a friend with this link for additional 7 days of free trial.</strong>
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (isset($hascard))
<input type="hidden" id="hascard" value="{{ $hascard ? 1 : 0}}" />
@endif
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
<script>
    $.ajax({
        url: '{{ url('braintree/token') }}'
    }).done(function (response) {
      //console.log(response);
        braintree.setup(response.data.token, 'dropin', {
            container: 'dropin-container',
            onReady: function () {
                $('#btnPaymentDetailsSubmit').removeClass('hidden');
            }
        });
    });

    @if(Session::has('success'))
      showSuccessToast("{!! Session::get('success') !!}");
    @endif

    @if(Session::has('error'))
      showErrorToast("{!! Session::get('error') !!}");
    @endif

</script>
<script>
$(document).ready(function() {

    var frmPass = $('#chgPass');
    var frmName = $('#chgName');
    var frmPlan = $('#chgPlan');
    var passFormValidator = frmPass.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            current_password:"required",
            password:"required",
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            current_password:"Please enter your current password",
            password:"Please enter your new password",
            password_confirmation: {
                required: "Please confirm your new password",
                equalTo: "Please enter the same password as confirmation"
            }
        }
    });
    var nameFormValidator = frmName.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            name:"required"
        },
        messages: {
            name: "Please enter your new username"
        }
    });

    frmPass.submit(function(e){

      var errorCount = passFormValidator.numberOfInvalids();
      if (errorCount > 0) {
          return false;
      }

        e.preventDefault();

        var formData = frmPass.serialize();
        $('#ibox2').children('.ibox-content').toggleClass('sk-loading');

        formData += '&' + $('#submit_pass_btn').attr('name') + '=' + $('#submit_pass_btn').attr('value');
        var passCall = $.ajax({
            type: frmPass.attr('method'),
            url: frmPass.attr('action'),
            dataType: 'text',
            data: formData
        }).done(function(data){
            $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
            if (data == "ok") {
                showSuccessToast("Your password has been changed successfully");
                $("#current_password").val("");
                $("#password").val("");
                $("#password_confirmation").val("");
            } else {
                var d = JSON.parse(data);
                console.log(d);
                $.each(d.errors, function(key, value){
                    console.log("key: " + key + "; value: " + value);
                    console.log(passFormValidator);
                    var obj = new Object();
                    obj[key] = value;
                    passFormValidator.showErrors(obj);
                });
            }
        });
    });

    frmName.submit(function(e){

        var errorCount = nameFormValidator.numberOfInvalids();
        if (errorCount > 0) {
            return false;
        }
        var name = $("#name").val();

        e.preventDefault();

        var formData = frmName.serialize();
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');

        formData += '&' + $('#submit_name_btn').attr('name') + '=' + $('#submit_name_btn').attr('value');
        var passCall = $.ajax({
            type: frmPass.attr('method'),
            url: frmPass.attr('action'),
            dataType: 'text',
            data: formData
        }).done(function(data){
          $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
            if (data == "ok") {
                $("#username").html('<strong class="font-bold">'+name+'</strong>');
                showSuccessToast("Your username has been changed successfully");
            } else {
                showErrorToast("Your username could not be changed");
            }
        });
    });

    var newPlan;

    frmPlan.each(function () {
        var that = $(this); // define context and reference
        $("button:submit", that).bind("click keypress", function ()
        {
            that.data("callerid", this.id);
        });
    });

    frmPlan.submit(function(e){
        var btnName;
        var callerId = $(this).data("callerid");
        if (callerId == "submit_plan_btn") {
            btnName = $('#submit_plan_btn').attr('name');
            var paythrough = $("#paythrough").val();
            if (paythrough=='Paypal') {
                console.log("Paypal payment");
                normalFormSubmit();
            }
            else
            {
              updatePlan(e, btnName);
            }
        } else if (callerId == "submit_cancel_btn") {
            btnName = $('#submit_cancel_btn').attr('name');
            //check if user is really sure and later provide feedback on why
            swal({
                title: "Are you sure?",
                text: "Cancel your subscription?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, cancel it!",
                closeOnConfirm: true},
                function (isConfirm) {
                    if (isConfirm) {
                        //cancel subscription
                        updatePlan(e, btnName);
                    }
                  });
        } else {
            console.log("attemp to resume plan");
            btnName = $('#submit_resume_btn').attr('name');
            updatePlan(e, btnName);
        }
        e.preventDefault();

    });

    function updatePlan(e, btnName) {

      var formData = frmPlan.serialize();
      $('#ibox3').children('.ibox-content').toggleClass('sk-loading');

      formData += '&' + btnName + '=' + $('#submit_plan_btn').attr('value');
      var passCall = $.ajax({
          type: frmPlan.attr('method'),
          url: frmPlan.attr('action'),
          dataType: 'text',
          data: formData
      }).done(function(data){
          $('#ibox3').children('.ibox-content').toggleClass('sk-loading');
          if (data == "ok" && btnName == "plan_change") {
              showSuccessToast("Your subscription has been updated successfully");
              swal({
                  title: "Done!",
                  text: "Your subscription has been updated successfully!",
                  type: "success"
              });
              @if (App::environment() == "production")
                    gtag('event', 'conversion', {
                        'send_to': 'AW-789332507/iljjCIXJzYkBEJuEsfgC',
                        'value': 39,
                        'currency': 'USD'
                    });
                    fbq('track', 'Subscribe');
                    _fprom = window._fprom || []; window._fprom = _fprom;
                    _fprom.push(["event", "signup"]);
                    _fprom.push(["email", "{{ $user->email }}"]);
                    _fprom.push(["uid", "{{ $user->id }}"]);
              @endif
              //todo change selection and disable button
              location.reload();
          } else if (data == "ok" && btnName == "plan_cancel") {
            showSuccessToast("Your subscription has been canceled");
            swal({
                title: "Done!",
                text: "Your subscription has been canceled. You might reactivate it within your grace period!",
                type: "success"
            });
            //todo change selection and disable button
            //$("#submit_cancel_btn").attr("disabled", "disabled");
            @if (App::environment() == "production")
                  fbq('track', 'Cancel');
            @endif
            location.reload();
          } else if (data == "ok" && btnName == "plan_resume") {
            showSuccessToast("Your subscription has been resumed");
            swal({
                title: "Done!",
                text: "Your subscription has been resumed. Glad to have you back!",
                type: "success"
            });
            //todo change selection and disable button
            //enable
            //$("#selSubscription").attr("disabled", "");
            @if (App::environment() == "production")
                fbq('track', 'Resume');
            @endif
            location.reload();
          } else {
              showErrorToast("Your subscription could not be changed");
          }
      });
    }

    @if(sizeof($getCustomerInfo->paymentMethods)>0)
    $('#selSubscription').on('change', function() {
      var currentPlan = $("#currentPlan").val();
      console.log(currentPlan, this.value);
      if (this.value == currentPlan)
      {
          $("#submit_plan_btn").attr("disabled", "disabled");
      }
      else
      {
          $("#submit_plan_btn").removeAttr("disabled");
      }
    });
    @endif



    $('#cancel-plan').on('click', function() {

      swal({
      title: "Are you sure?",
      text: "Cancel your subscription?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, cancel it!",
      closeOnConfirm: true},
      function (isConfirm) {
          if (isConfirm) {
              //cancel subscription
              cancelPlan();
          }
        });
    });

    function cancelPlan()
    {
      $('#ibox3').children('.ibox-content').toggleClass('sk-loading');
      $.ajax({
        type: "POST",
        url: "{{route('updateAccount')}}",
        data:'plan_cancel=plan_cancel',
        headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        success: function(data){
          $('#ibox3').children('.ibox-content').toggleClass('sk-loading');
          showSuccessToast("Your subscription has been canceled");
            swal({
                title: "Done!",
                text: "Your subscription has been canceled. You might reactivate it within your grace period!",
                type: "success"
            });
            //todo change selection and disable button
            //$("#submit_cancel_btn").attr("disabled", "disabled");
            @if (App::environment() == "production")
                fbq('track', 'Cancel');
            @endif
            location.reload();
        }
      });
    }

    $('#loadInvoices').on('click', function() {

        $('#invoices').DataTable( {
            buttons: [],
            dom: '<"html5buttons"B>it',
            scrollY: '30vh',
            responsive: true,
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            paging: true,
            "ajax": {
                "url": "/api/invoices-list",
                headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataType": "json",
                "type": "GET",
                "data": function(d) {
                    d._token = "{{ csrf_token() }}";
                  }
            },
            "columns": [
              {"data": "date"},
              {"data": "total"},
              {"data": "download"}
            ]
        });
    });

    function copyTextToClipboard(text) {

       var textArea = document.createElement( "textarea" );
       textArea.value = text;
       document.body.appendChild( textArea );

       textArea.select();

       try {
          var successful = document.execCommand( 'copy' );
          var msg = successful ? 'successful' : 'unsuccessful';
          console.log('Copying text command was ' + msg);
       } catch (err) {
          console.log('Oops, unable to copy');
       }

       document.body.removeChild( textArea );
    }

    $('#copyAffiliateLink').click( function() {
         var clipboardText = "";

         clipboardText = $('#affiliateLink').val();

         copyTextToClipboard( clipboardText );
         showSuccessToast("Link has been copied.");
    });

});
</script>
@endsection
