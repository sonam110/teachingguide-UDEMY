<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>You subscription has been updated </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css?v=123') }}" rel="stylesheet">

</head>
<body id="page-top" class="landing-page no-skin-config">

<section class="services" style="margin-top:0;padding-top:40px;padding-bottom:40px">
  <div class="container">
      <div class="row m-b-lg">
          <div class="col-lg-12 text-center">
            <div class="navy-line" style="margin: 15px auto 0px;"></div>
            <h1>Hi {{ ucwords($user->name) }}!</h1>
            </br>
            </br>
            <p>Your subscription has been updated to "{{ $subscription-> name}}"</p>
            <p>All your permissions have been updated accordingly and our web application and data is ready for you.</p>
            </br>
            <p>Teachinguide is still young and needs your feedback to improve further and meet and exceed your expectations. So please use the feedback facility and help all of us.</p>
            </br>
            <p>Thank you again {{ ucwords($user->name) }} and lets get started!</p>
            </br>
            <a href="{{Request::root()}}/dashboard" class="btn btn-primary">Dashboard</a>
        </div>
    </div>
  </div>
</section>

<section id="contact" class="contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>We would love to hear from you, get valuable feedback and ideas on how to further improve our service.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:hello@teachinguide.com" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li>
                        <a href="https://twitter.com/teachinguide"><i class="fa fa-twitter"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2018 TeachinGuide</strong><br/> TeachinGuide is in no means affiliated with Udemy or any of its sibsidiaries.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
              <a href="{{ route('termsofuse') }}">Terms of Use</a>
               -
              <a href="{{ route('privacyandpolicy') }}">Privacy Policy</a>

            </div>
        </div>
    </div>
</section>
</body>
</html>
