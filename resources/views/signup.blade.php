@extends('layouts.signup')

@section('css')
<link href="{{ asset('assets/css/home.css?v=123') }}" rel="stylesheet">
<style type="text/css" media="screen">
  .has-error input {
    border-width: 2px;
  }
</style>
@endsection

@section('content')

  <div class="container logo-container">
      <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <a style="" class="navbar-brand" href="/"><!--Teaching Guide--><img class="logowhite" style="width:300px;" src="{{ asset('assets/img/logo/logo_white.svg') }}"></a>
          </div>
          <div class="col-md-3"></div>

      </div>
  </div>
  <div class="bgoverlay"></div>

  <div class="loginColumns animated fadeInDown">
      <div class="row">
          <div class="col-md-6">
              <div class="ibox" id="ibox1">
                  <div class="ibox-content">
                  <!-- start of new form -->
                      <div class="sk-spinner sk-spinner-double-bounce">
                          <div class="sk-double-bounce1"></div>
                          <div class="sk-double-bounce2"></div>
                      </div>

                      <form id="form" method="POST" action="{{ route('store') }}">
                        @csrf
                      <div>
                          <h1>Create your account</h1>
                          <p>Getting started with Teachinguide is easy and only a few steps!</p>
                          <section>
                              <div class="row">
                                  @if(Session::has('success'))
                                    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('success') !!} </div>
                                    @endif

                                    @if(Session::has('error'))
                                    <div class="alert alert-danger login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
                                    @endif

                                    @if(Session::has('warning'))
                                    <div class="alert alert-warning login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('warning') !!} </div>
                                    @endif

                                    @if(Session::has('info'))
                                    <div class="alert alert-info login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('info') !!} </div>
                                    @endif

                                    @if ($errors->any())
                                    <div class="alert alert-danger login-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                      </ul>
                                    </div>
                                    @endif
                                  <div class="col-md-6">


                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input id="firstname" placeholder="Firstname" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                          @if ($errors->has('first_name'))
                                              <span class="invalid-feedback">
                                              <strong>{{ $errors->first('first_name') }}</strong>
                                          </span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input id="lastname" placeholder="Lastname" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                          @if ($errors->has('last_name'))
                                              <span class="invalid-feedback">
                                              <strong>{{ $errors->first('last_name') }}</strong>
                                          </span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input id="email" placeholder="E-Mail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                          @if ($errors->has('email'))
                                              <label id="password-error" class="error" for="password">{{ $errors->first('email') }}</label>
                                          </span>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div id="#pwd-container" class="form-group">
                                          <label>Password</label>
                                          <input id="password" placeholder="********" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                          @if ($errors->has('password'))
                                              <span class="invalid-feedback">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                          @endif
                                          <div class="pwstrength_viewport_progress"></div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Password Confirmation</label>
                                          <input id="password-confirm" placeholder="Retype Password" type="password" class="form-control" name="password_confirmation" required>
                                      </div>
                                  </div>
                              </div>
                          </section>

                          <section>
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="form-group" id="selectSubscription">
                                          <div>
                                              <label>Subscription</label>
                                              <select id="selSubscription" name="plan" data-placeholder="Subscription" class="form-control m-b required">
                                                  <!-- <option value="">Choose Your Subscription</option> -->

                                                  @if (isset($coupon))
                                                      @foreach($products as $product)
                                                          <option
                                                              value="{{$product->id}}" {{ $product_id == $product->id ? 'selected="selected"' : '' }}>{{$product->name}} - {{round($product->cost / $product->billing_frequency * (1 - 50/100), 0, PHP_ROUND_HALF_DOWN)}} USD per month
                                                          </option>
                                                      @endforeach
                                                  @else
                                                      @foreach($products as $product)
                                                          <option
                                                              value="{{$product->id}}" {{ $product_id == $product->id ? 'selected="selected"' : '' }}>{{$product->name}} - {{round($product->cost  / $product->billing_frequency ) }} USD per month
                                                          </option>
                                                      @endforeach
                                                  @endif
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>


                          <section>

                              <div id="cc-section">
                                  <div class="row">
                                    <div>
                                      <div class="payment">
                                        <div class="col-lg-12">
                                          <!-- <div id="dropin-container"></div> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div id="stripe-div">

                                    <div class="row">
                                      <div class="col-lg-6">
                                          <div class="control-group">
                                                @if (isset($coupon_id))
                                                <input type="hidden" class="form-control" id="couponCode" name="couponCode" placeholder="Valid Coupon Code" data-stripe="coupon" value="{{$coupon_id}}">
                                                @else
                                                <input type="hidden" class="form-control" id="couponCode" name="couponCode" placeholder="Valid Coupon Code" data-stripe="coupon" value="">
                                                @endif
                                          </div>
                                      </div>
                                    </div>
                                    <!-- <div class="row">
                                          <div class="col-md-5" style="font-size: 22px;">
                                              <i class="card-icon fa fa-cc-mastercard"></i>
                                              <i class="card-icon fa fa-cc-discover"></i>
                                              <i class="card-icon fa fa-cc-visa"></i>
                                              <i class="card-icon fa fa-cc-amex"></i>
                                          </div>
                                          <div class="col-md-7">
                                              <i class="fa fa-lock"></i><span style="font-size: 12px;"> this is a secure 128-bit ssl encrypted payment</span>
                                          </div>
                                    </div> -->
                                  </div>
                              </div>


                              <div class="row" style="margin-top:10px;">
                                  <div class="col-md-12">
                                      <input style="" id="payment-button" class="btn btn-primary btn-block btn-lg btn-flat " type="submit" value="Try Free">
                                  </div>
                              </div>
                              <div class="row" style="margin-top:10px;">
                                  <div class="col-md-12 text-center">
                                      <span style="font-size: 12px;">
                                          By clicking the button you agree to our <strong><a target="_blank" href="{{ route('termsofuse') }}">Terms and Conditions</strong></a>
                                          and have read through our <strong><a target="_blank" href="{{ route('privacyandpolicy') }}">Privacy Statement</strong></a>.
                                      </span>
                                  </div>
                              </div>
                          </section>
                      </div>
                      </form>
                  </div>
            </div>

                  <!-- end of new form-->

          </div>
          <div class="col-md-6">
              <div class="ibox" id="ibox1">
                  <div class="ibox-content">
                      <div id="included">

                      </div>
                  </div>
              </div>

          </div>
      </div>
  </div>

  <div class="container-fluid footer-col">
      <hr/>
      <div class="row">
          <div class="col-md-6 whitetext">
              TeachinGuide
          </div>
          <div class="col-md-6 text-right">
              <small class="whitetext">© 2018</small>
          </div>
      </div>
  </div>
@endsection


@section('scripts')
{{--<!-- Mainly scripts -->--}}

<!-- Jquery Validate -->
<script src="{{ asset('assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{asset('assets/js/passstrength.js?v=1.2')}}"></script>
@endsection
@section('braintree')
<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
<script>
    $.ajax({
        url: '{{ url('braintree/token') }}'
    }).done(function (response) {
      //console.log(response);
        braintree.setup(response.data.token, 'dropin', {
            container: 'dropin-container',
            onReady: function () {
                //$('#payment-button').removeClass('hidden');
            }
        });
    });
</script>
<script type="text/javascript">
  var sub = $("#selSubscription").val();
    var code = $("#couponCode").val();

    $.get("/api/signup-included?sub="+sub+"&coupon="+code, function(data, status){
          $("#included").html(data);
    });

    $("#selSubscription").on("change", function() {
      var sub = $("#selSubscription").val();
      var code = $("#couponCode").val();
      $.get("/api/signup-included?sub="+sub+"&coupon="+code, function(data, status){
            $("#included").html(data);
      });
    });
</script>
<script>
var form = jQuery("#form");
var validator = form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
    
$(document).ready(function () {
    //track facebook event for pixel on - Initiate Checkout
    @if (App::environment() == "production")
        fbq('track', 'InitiateCheckout');
    @endif
    var form = document.getElementById('form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var errorCount = 0;
            // var errorCount = validator.numberOfInvalids();

            if (errorCount > 0) {
                console.log("error");
                return false;
            }
            @if (App::environment() == "production")
                fbq('track', 'StartTrial');
            @endif

            form.submit();
        });
});
</script>
@endsection
