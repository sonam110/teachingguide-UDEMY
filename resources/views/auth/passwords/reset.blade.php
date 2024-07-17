<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="short icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <title>teachinGuide | Forgot password</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}} " rel="stylesheet">

</head>

<body id="registration" class="no-skin-config forgot">

<div class="bgoverlay"></div>

<div class="container logo-container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a style="" class="navbar-brand" href="/"><!--Teaching Guide--><img class="logowhite" height="90" src="/assets/img/logo-white.png"></a>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>

<div class="loginColumns animated fadeInDown">
    <div class="row">
      <div class="col-md-4 textcolum"></div>
      <div class="col-md-4">
          <h2 class="text-center whitetext regtitle">Reset password</h2>

          <p class="text-center whitetext font-bold">
              Enter your E-Mail and set a new password.
          </p>
          <div class="ibox-content">
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-Mail address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" placeholder="New Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="New Password Confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12" style="text-align: right">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>

<!-- Steps -->
<script src="{{ asset('assets/js/plugins/steps/jquery.steps.min.js') }}"></script>

<!-- Jquery Validate -->
<script src="{{ asset('assets/js/plugins/validate/jquery.validate.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!-- Mainly scripts -->


<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/js/passstrength.js?v=1.2')}}"></script>

<script src="{{asset('assets/js/plugins/wow/wow.min.js')}}"></script>


<script>
    var form = jQuery("#form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });

    //$('#acceptTerms').iCheck('uncheck');

</script>

</body>
</html>
