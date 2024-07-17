@extends('layouts.base')

@section('css')
<link href="{{ asset('assets/css/home.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')

<div class="bgoverlay"></div>

<div class="container logo-container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a style="" class="navbar-brand" href="/"><!--Teaching Guide--><img class="logowhite" style="width:300px;" src="{{ asset('assets/img/logo/logo_white.svg') }}"></a>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>


<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="text-center whitetext regtitle">Login</h1>
            <div class="ibox-content">

                <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="E-Mail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <input id="login" {{ old('remember') ? 'checked' : '' }} name="remember" class="styled required" type="checkbox">
                            <label for="login">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary block center text-bold login-button full-width">Login</button>
                        <p class="text-center"><a href="{{ route('password.request') }}"><small>Forgot password?</small></a></p>
                        <p class="text-muted text-center"><small>Do not have an account?</small></p>

                        <a class="btn btn-sm btn-white block center text-bold" href="{{ route('signup') }}">Create an account</a>
                    </div>
                </form>


                <!-- end of new form-->

            </div>
        </div>

        <div class="col-md-4"></div>
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
@endsection
