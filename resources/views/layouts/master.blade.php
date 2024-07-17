<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="description" content="{{ isset($meta) ? $meta : 'Teachinguide provide competitive information for online instructor to succeed on Udemy and other learning platform.'}}">
    <meta name="author" content="">

    <link rel="short icon" type="image/png" href="{{ asset('assets/img/logo/fav_color.png') }}">
    @if (App::environment() == "production")
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123518646-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-123518646-1');
          gtag('config', 'AW-789332507');
        </script>
        <!-- Google Tag Manager -->
        <script>
          (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
          j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
          'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
          })(window,document,'script','dataLayer','GTM-N95B8TX');
        </script>
        <!-- End Google Tag Manager -->

        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '480348219141573');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=480348219141573&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->


        <!-- Hotjar Tracking Code for https://teachinguide.com -->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:991846,hjsv:6};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
        </script>

        <!-- Start of Async Drift Code -->
        <script>
          "use strict";

          !function () {
            var t = window.driftt = window.drift = window.driftt || [];
            if (!t.init) {
              if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
              t.invoked = !0, t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on"],
                t.factory = function (e) {
                  return function () {
                    var n = Array.prototype.slice.call(arguments);
                    return n.unshift(e), t.push(n), t;
                  };
                }, t.methods.forEach(function (e) {
                  t[e] = t.factory(e);
                }), t.load = function (t) {
                  var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                  o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                  var i = document.getElementsByTagName("script")[0];
                  i.parentNode.insertBefore(o, i);
                };
            }
          }();
          drift.SNIPPET_VERSION = '0.3.1';
          drift.load('ymza25h6m7hh');
        </script>
        <!-- End of Async Drift Code -->

        <!-- Start of FirstPromotor Code -->
        <script type="text/javascript">
          (function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://cdn.firstpromoter.com/fprom.js',t.onload=t.onreadystatechange=function(){var t=this.readyState;if(!t||"complete"==t||"loaded"==t)try{$FPROM.init("rrd9hrr5",".teachinguide.com")}catch(t){}};var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)})();
        </script>
        <!-- End of FirstPromotor Code -->
    @endif

    <title>{{ isset($title) ? $title : 'Teachinguide - Online Teaching Research Tools and Resources to Earn Money Full- or Part Time.' }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">

    @yield('css')

</head>
  <!-- Chatfuel Facebook Messenger Code -->
  <!-- <script>
        window.fbMessengerPlugins = window.fbMessengerPlugins || {
          init: function () {
            FB.init({
              appId            : '1678638095724206',
              autoLogAppEvents : true,
              xfbml            : true,
              version          : 'v3.0'
            });
          }, callable: []
        };
        window.fbAsyncInit = window.fbAsyncInit || function () {
          window.fbMessengerPlugins.callable.forEach(function (item) { item(); });
          window.fbMessengerPlugins.init();
        };
        setTimeout(function () {
          (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) { return; }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        }, 0);
  </script> -->
@if ($landing == 'h')
<body id="page-top" class="landing-page no-skin-config">
  @include('includes.navigation')
@endif
@if ($landing == 'g')
<body id="page-top" class="landing-page no-skin-config">
  @include('includes.navigation-logo')
@endif
@if ($landing == 'p')
<body id="page-top" class="landing-page no-skin-config product-page seprate-page">
  @include('includes.navigation')
@endif
@if ($landing == 'cD')
<body id="page-top" class="landing-page no-skin-config courserDatabase-page seprate-page">
  @include('includes.navigation')
@endif
@if ($landing == 'about')
<body id="page-top" class="landing-page no-skin-config about-page seprate-page">
  @include('includes.navigation')
@endif
@if ($landing == 'estimator')
<body id="page-top" class="landing-page no-skin-config estimator-page seprate-page">
  @include('includes.navigation')
@endif
@if ($landing == 'freecourses')
<body id="page-top" class="landing-page no-skin-config freecourses-page seprate-page">
  @include('includes.navigation')
@endif

@yield('content')

<!-- Mainly scripts -->
<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('assets/js/plugins/wow/wow.min.js') }}"></script>
@yield('scripts')

@if (App::environment() == "production")
    @if ($landing == 'h')
    <script src="https://my.hellobar.com/ed10cda21db0e356a85d1c5abe7e94e9e834825c.js" type="text/javascript" charset="utf-8" async="async"></script>
    @endif
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N95B8TX"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif

</body>
</html>