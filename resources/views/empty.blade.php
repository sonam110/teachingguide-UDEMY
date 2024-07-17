<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <link rel="short icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

        <title>Chatfuel Testpage</title>

    <!-- Bootstrap core CSS -->

</head>
<body id="page-top" class="landing-page no-skin-config">
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
            //js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));
        }, 0);
  </script>

  <!-- Load Facebook SDK for JavaScript -->

<!-- <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

<!-- Your customer chat code -->

  <div class="fb-customerchat"
    page_id="286159098851964"
    ref="utm_channel=messenger">
  </div>
</body>
</html>
