<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="description" content="Teachinguide provide competitive information for online instructor to succeed on Udemy and other learning platforms.">
    <meta name="author" content="">

    <link rel="short icon" type="image/png" href="{{ asset('assets/img/logo/fav_color.svg') }}">

    @if (App::environment() == "production")
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123518646-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-123518646-1');
        </script>
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

        <!-- Chatfuel Facebook Messenger Code -->
        <script>
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
        </script>
    @endif

    <title>
        @if(isset($title))
          {{ $title }}
        @else
          teachinguide
        @endif
         - Become a Successful Instructor with Teachinguide</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body id="page-top" class="landing-page no-skin-config">
@include('includes.navigation2')

@yield('content')

<!-- Mainly scripts -->
<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('assets/js/plugins/wow/wow.min.js') }}"></script>


@yield('scripts')
</body>
</html>
