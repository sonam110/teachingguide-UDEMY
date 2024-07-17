<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact Message</title>

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
            <h1>To Teachinguide!</h1>
            </br>
            <p>
              {{ $msg }}
            </p>
        </div>
    </div>
  </div>
</section>

</body>
</html>
