<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>teachinGuide | Dashboard</title>

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    @yield('css')

</head>

<body>
    <div id="wrapper">
        @include('includes.webapp.sidebarNavigation')

        <div id="page-wrapper" class="gray-bg dashbard-1">
          @include('includes.webapp.headerNavigation')
          @yield('content')

        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{ asset('assets/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/js/inspinia.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- GITTER -->
    <script src="{{ asset('assets/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ asset('assets/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{ asset('assets/js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{ asset('assets/js/plugins/toastr/toastr.min.js')}}"></script>

    @yield('scripts')

</body>
</html>
