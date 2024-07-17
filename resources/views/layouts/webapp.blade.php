<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>

    <meta charset="utf-8">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
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
            (function () { var t = document.createElement("script"); t.type = "text/javascript", t.async = !0, t.src = 'https://cdn.firstpromoter.com/fprom.js', t.onload = t.onreadystatechange = function () { var t = this.readyState; if (!t || "complete" == t || "loaded" == t) try { $FPROM.init("rrd9hrr5", ".teachinguide.com") } catch (t) { } }; var e = document.getElementsByTagName("script")[0]; e.parentNode.insertBefore(t, e) })();
        </script>
        <!-- End of FirstPromotor Code -->

    @endif

    <title>teachinGuide | Dashboard</title>

    <!-- <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://querybuilder.js.org/assets/css/docs.min.css" rel="stylesheet">
    <link href="https://querybuilder.js.org/assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/feedback.css?v=123') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/bootstrapTour/bootstrap-tour.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body class="fixed-sidebar">
    <button id="feedbackBtn" class="feedback-button btn btn-info" data-toggle="modal"  href="#feedback-main">Feedback</button>

    <div id="feedback-main" class="modal fade in">
        <div id="feedback-div">
          <div class="ibox-content">
                <div>
                    <h2>Thank you for your feedback!</h2>
                    <section>
                        <div class="form-group">
                          <input id="fbName" type="text" class="form-control" name="name" value="{{ Auth::User()->name }}" disabled />
                          <input id="fbUser" name="id" type="hidden"  value="{{ Auth::User()->id }}"/>
                        </div>

                        <div class="form-group">
                          <input id="fbPage" type="text" class="form-control" name="name" value="{{ Request::url() }}" />
                        </div>

                        <div class="form-group">
                          <input id="fbTitle" type="text" class="form-control" name="title" placeholder="Issue title" value="" autofocus/>
                        </div>

                        <div class="form-group">
                          <select id="fbCategory" name="category_id" data-placeholder="Issue Category" class="form-control m-b required"><option value="0">Choose Incident Category</option>
                              <option value="1">Data Quality</option>
                              <option value="2">User Interface</option>
                              <option value="3">Website Error</option>
                              <option value="4">Performance</option>
                              <option value="5">Feature Request</option>
                              <option value="6">General Feedback</option>
                              <option value="7">Other</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <select id="fbPriority" name="priority_id" data-placeholder="Issue Priority" class="form-control m-b required"><option value="0">Choose Priority Level</option>
                              <option value="1">Low</option>
                              <option value="2">Medium</option>
                              <option value="3">High</option>
                              <option value="4">Critical</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <div class="note-editor note-frame panel panel-default">
                              <div id="fbDescription" class="note-editable panel-body note-editing-area" style="height: 283px; overflow:auto;" contenteditable="true" placeholder="Please enter your description and steps you have taken to get there."></div>
                          </div>
                        </div>
                    </section>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input class="btn btn-default" data-dismiss="modal" type="cancel" value="Cancel" style="float: left; width: 100px;">
                        </div>
                    </div>
                    <div class="col-xs-6">
                      <div class="form-group">
                          <input id="btnFeedbackSubmit" class="btn btn-primary" type="submit" value="Submit" style="float: right; width: 100px;">
                      </div>
                    </div>
                </div>

          </div>
        </div>

    </div>
    <div id="wrapper">
        @include('includes.webapp.sidebarNavigation')

        <div id="page-wrapper" class="gray-bg dashbard-1">
          @include('includes.webapp.headerNavigation')
          @yield('content')


        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrapTour/bootstrap-tour.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

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
    <script src="{{ asset('assets/js/feedback.js?v=123') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

    @if (App::environment() == "production")
    <script>
        drift.on('ready', function (api, payload) {
            //api.widget.hide();
            api.hideWelcomeMessage();
        })
    </script>
    @endif


    @yield('scripts')
</body>
</html>
