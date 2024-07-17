@extends('layouts.base')

@section('css')
<link href="{{ asset('assets/css/home.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container logo-container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a style="" class="navbar-brand" href="/"><!--Teaching Guide--><img class="logowhite" height="90" src="assets/img/logo/logo_white.svg"></a>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>
<div class="bgoverlay"></div>

  <div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-lg-12 text-center whitetext" style="font-size: 20px;">
            <div class="navy-line" style="margin: 15px auto 0px;"></div>
            <h1>{{ ucwords($user->first_name) }}, your free eBook is on its way!</h1>
            </br>
            </br>
            <p>Thank you for trying teachinguide and making a huge step towards Udemy Mastery!</p>
            </br>
            <p>We promissed you our eBook on "5 Methods For Growing Udemy Courses fast". Please check you EMail. It will be there in a minute.</p>
            </br>
            <p>In the meantime check out our blog.</p>
            </br>
            <a href="{{Request::root()}}/blog" class="btn btn-success btn-lg">Teachinguide Resource Blog</a>
            </br>
            </br>
            <p>Thank you again {{ ucwords($user->first_name) }} and enjoy reading!</p>
            </br>

        </div>
    </div>
  </div>
</br></br></br>
  <section id="about" class="contact whitetext">
      <div class="container">
          <div class="row m-b-lg">
              <div class="col-lg-12 text-center">
                  <div class="navy-line"></div>
                  <h1>Contact Us</h1>
                  <p>We at teachinguide provide competitive information for online instructor to succeed on Udemy and other learning platforms. </p>
                  </br>
                  <p>We would love to hear from you, get valuable feedback and ideas on how to further improve our service.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-12 text-center">
                  <a href="mailto:hello@teachinguide.com" class="btn btn-success">Send us mail</a>
                  <p class="m-t-sm">
                      Or follow us on social platform
                  </p>
                  <ul class="list-inline social-icon">
                      <li><a href="https://twitter.com/teachinguide"><i class="fa fa-twitter"></i></a></li>
                      <li><a href="https://www.facebook.com/teachinguide"><i class="fa fa-facebook"></i></a></li>
                  </ul>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                  <p><strong>&copy; 2018 TeachinGuide</strong><br/> TeachinGuide is in no means affiliated with Udemy or any of its subsidiaries.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <a class="whitetext" href="{{ route('termsofuse') }}">Terms of Use</a>
                 -
                <a class="whitetext" href="{{ route('privacyandpolicy') }}">Privacy Policies</a>
                -
                <a class="whitetext" href="http://eepurl.com/dE4eQf">Newsletter</a>

              </div>
          </div>
      </div>
  </section>

@endsection

@section('scripts')

@if (App::environment() == "production")
<!-- Event snippet for Teachinguide Email Signup page -->

<!-- ToDo add google adwords event tracker -->

<script>
    fbq('track', 'Lead');
</script>
@endif

@endsection
