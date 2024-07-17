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
            <h1>Welcome to teachinguide {{ ucwords($user->name) }}!</h1>
            </br>
            </br>
            <p>Thank you {{ ucwords($user->name) }} for trying teachinguide and making a huge step towards Udemy Mastery!</p>
            <p>All your permissions have been granted and our web application and data is ready for you.</p>
            <p>You can reach your personal dashboard after login in on the home page or by clicking the Dashboard-button below.</p>
            </br>
            <p>We promissed you our eBook on "5 Methods For Growing Udemy Courses fast" and here it is. <a target="blank" href="/files/Top5MethodsForGrowingUdemyCourses.pdf">Download</a></p>
            </br>
            <p>Teachinguide is still young and needs your feedback to improve further and meet and exceed your expectations. So please use the feedback facility and help all of us.</p>
            </br>
            <p>Thank you again {{ ucwords($user->name) }} and lets get started!</p>
            </br>
            <a href="{{Request::root()}}/dashboard" class="btn btn-primary btn-lg">Dashboard</a>
            @if(!empty(Auth::user()->trial_ends_at))
            <a class="btn btn-success btn-lg" href="/account?tab=affiliate" role="button">Additional 7 days of free trial</a>
            @endif
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
@endsection
