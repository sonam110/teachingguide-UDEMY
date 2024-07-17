@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/css/cookieconsent.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/product.css') }}" rel="stylesheet" />
@endsection

@section('content')

<section id="pricing" class="pricing">
  <div class="row">
      <div class="container">
          <div class="col-lg-12 text-center margin-bottom-10 pricing-section-title">
              <div class="navy-line"></div>
              <h1>
                <strong>
                  <span class="rwd-line">The Web App Pricing Plan</span>
                </strong>
              </h1>
          </div>
          <div class="col-lg-12 text-center margin-bottom-10">
              <h2>
                7 day free trial. Risk Free. 100% Money back guarantee. Upgrade any time.
              </h2>
          </div>
      </div>
  </div>

    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line navy-line-border-bottm-none"></div>
                <div class="price-table-btns">
                  <a class="js-btn js-monthly-table-btn active" href="#"><strong>Monthly</strong></br>Test It!</a>
                  <a class="js-btn js-yearly-table-btn text-center" href="#" data-toggle="tooltip" title="Save 3 month!"><strong>Yearly</strong></br>Save 3 Month!</a>
                </div>
                <h3><strong>
                  <span class="rwd-line2"><i>Early adopter 50% off sales discounts </i></span>
                </strong>
                <span class="rwd-line2"> for first 100 subscriptions, few left!</h3></span>
            </div>
        </div>
        <div class="row ptable price-box-main">
          <div class="col-lg-4 wow zoomIn price-box-inner margin-top-20">
                <img class="salesBadge" src="https://teachinguide.com/assets/img/50Off-min.png" alt="sales 50 percent off" />
                <ul class="pricing-plan list-unstyled border-1">
                    <li class="pricing-title">
                        Insider
                    </li>
                    <li class="pricing-desc">
                        GET PROFITABLE INSIGHTS!
                    </li>
                    <li class="mcost">
                        <strong><span class="though">&#36;39</span> &#36;19<span class="nothough">/month</span></strong>
                    </li>
		                <li class="ycost">
                        <strong><span class="though"> &#36;29</span> &#36;14<span class="nothough">/month</span></strong>
                    </li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Dashboards</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;5 Course Tracker</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Rankings</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Monitor 5 Competitors</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Full Database Filtering</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Topic KPIs & Trends</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Author KPIs & Trends</li>
                    <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Data Downloads</li>

                    <li class="plan-action button bottom-btn">
                        <a class="btn btn-primary btn-xs insightSignup" href="/signup?sub=3&coupon=TG50FIRST100">Try Free</a>
                    </li>
                </ul>
            </div>
          <div class="col-lg-4 wow zoomIn price-box-inner">
              <img class="salesBadge" src="https://teachinguide.com/assets/img/50Off-min.png" alt="sales 50 percent off"/>
              <ul class="pricing-plan list-unstyled border-10">
                  <li class="pricing-title">
                      Compete
                  </li>
                  <li class="pricing-desc">
                      DOMINATE YOUR COMPETITION!
                  </li>
                  <li class="mcost">
                      <strong><span class="though">&#36;79</span> &#36;39<span class="nothough">/month</span></strong>
                  </li>
                  <li class="ycost">
                      <strong><span class="though">&#36;59</span> &#36;29<span class="nothough">/month</span></strong>
                  </li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Dashboards</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;20 Course Tracker</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Rankings</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Monitor 20 Competitors</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Full Database Filtering</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Topic KPIs & Trends</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Author KPIs & Trends</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Data Downloads</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Hunter</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Google Trends</li>

                  <li class="button bottom-btn">
                      <a class="btn btn-primary btn-xs competeSignup" href="/signup?sub=1&coupon=TG50FIRST100">Try Free</a>
                  </li>
              </ul>
          </div>
          <div class="col-lg-4 wow zoomIn price-box-inner margin-top-20">
             <img class="salesBadge" src="https://teachinguide.com/assets/img/50Off-min.png" alt="sales 50 percent off"/>
              <ul class="pricing-plan list-unstyled border-1">
                  <li class="pricing-title">
                      Business
                  </li>
                  <li class="pricing-desc">
                      GROW YOUR BUSINESS!
                  </li>
                  <li class="mcost">
                      <strong><span class="though">&#36;199</span> &#36;99<span class="nothough">/month</span></strong>
                  </li>
                  <li class="ycost">
                      <strong><span class="though">&#36;159</span> &#36;79<span class="nothough">/month</span></strong>
                  </li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Dashboards</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;100 Course Tracker</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Rankings</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Monitor 100 Competitors</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Full Database Filtering</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Topic KPIs & Trends</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Author KPIs & Trends</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Data Downloads</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Hunter</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Google Trends</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Keyword Rank Tracker</li>
                  <li class="item"><i class="fa fa-check-square-o"></i>&nbsp;Backlink Optimizer</li>

                  <li class="button bottom-btn">
                      <a class="btn btn-primary btn-xs freeSignup" disabled href="/signup?sub=1&coupon=TG50FIRST100">Coming Soon</a>
                  </li>
              </ul>
          </div>


        </div>
    </div>
</section>

<section id="product">
    <div class="row">
        <div class="container">
            <div class="col-lg-12 text-center product-title">
                <div class="navy-line"></div>
                <h2>
                  <strong>
                    <span class="rwd-line2">"All The Most Powerful Udemy </span>
                    <span class="rwd-line2">Insights, Information And More...</span>
                    <span class="rwd-line2"><i>Right At Your Fingertips!"</i></span>
                  </strong>
                </h2>
            </div>
            <div class="col-lg-12 margin-bottom-30">
                <p>
                  TeachinGuide will provide you with <strong>current, high-quality and exclusive data and insights</strong> from Udemy. By having access to this exclusive data, you’ll have all the information you’ll need right at your fingertips to skyrocket your success as an online instructor and course creator on Udemy!
                </p>
            </div>
            <div class="col-lg-12 text-center margin-bottom-30">
                <h3>
                  <strong>
                    <i>
                      <span class="rwd-line">Let’s take a look at exactly</span>
                      <span class="rwd-line"> how TeachinGuide will benefit you...</span>
                    </i>
                  </strong>
                </h3>
            </div>
        </div>
    </div>

    <div class="row padding-bottom-60">
        <div class="container">
          <div class="col-lg-6 wow fadeInLeft">
              <h4><strong>Our Exclusive Course Database</strong></h4>
              <p>We’ve put together the most informative Udemy course database for you that’s easy to navigate and use. You can filter courses by ratings, reviews, number of enrollments, rankings and so much more! In a matter of minutes, you’ll be able to quickly discover what topics work and sell the very best on Udemy!</p>
              <p style="margin-bottom:30px"><a class="page-scroll btn btn-primary insicon tryfreebtn" href="{{ route('coursedatabase') }}" role="button">Learn more &raquo;</a></p>
          </div>
          <div class="col-md-6 text-center wow fadeInRight">
              <div class="videoWrapper">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/9-Hyknr0HrQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
              </div>
          </div>
      </div>
    </div>

    <div class="row padding-bottom-60">
      <div class="container">
        <div class="col-lg-6 wow fadeInRight f4 pull-right">
             <h4><strong>In Depth Topic Finder</strong></h4>
             <p>We’ve created one of the most critical research tools just for online instructors. Our Teachinguide Topic Finder. This is an outstanding way to identify and validate new topics to teach. Udemy Market Insights gives you just a brief validation of single topics. Our Topic Finder gives you the full picture of about 5'000 topics instantly! Find topics by detailed demand and competition. Make sure to understand Topics trends on Udemy and in Google Worldwide. <i>This is information is priceless!</i></p>
        </div>
        <div class="col-lg-6 text-right wow fadeInLeft f3 pull-left">
            <div class="videoWrapper">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/vQociuASDvo?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="container">
        <div class="col-lg-6 wow fadeInLeft">
            <h4><strong>Detailed Competitive Analysis</strong></h4>
            <p>Do you want to see detailed information regarding topics and keywords on Udemy that’s current and up-to-date? Now you can with TeachinGuide. You’ll be able to do competitive analysis to reveal the most promising (and lucrative!) niches as well as keywords you can easily rank for. <i>This data is a MUST if you want to outrank your competition!</i></p>
        </div>
        <div class="col-lg-6 wow fadeInRight">
            <div class="videoWrapper">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/0pCaqtiSF1c?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>
  </div>

</section>

<section id="about" class="contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
                <p>We at teachinguide provide competitive information for online instructors to succeed on Udemy and other learning platforms. </p>
                </br>
                <p><strong>The only independent solution to course topic research and keyword analytics for successful online teaching.</strong></p>
                </br>
                <p>We would love to hear from you, get valuable feedback and ideas on how to further improve our service.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="{{route('contactus')}}" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social a platform
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
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg privacy-links">
              <a href="{{ route('termsofuse') }}">Terms of Use</a>
               -
              <a href="{{ route('privacyandpolicy') }}">Privacy Policies</a>
              -
              <a href="http://eepurl.com/dE4eQf">Newsletter</a>

            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"d31b05e95c9687744ed6f3b65","lid":"7faa6cd4aa"}) })</script>

<script>

$(document).ready(function () {

    @if (App::environment() == "production")
      fbq('track', 'ViewContent');
    @endif

    console.log( "ready!" );
    $(".js-yearly-table-btn").click(function(){
        $(".mcost").hide();
        $(".ycost").show();
        $(".js-yearly-table-btn").addClass("active");
        $(".js-monthly-table-btn").removeClass("active");
        $(".ptable").fadeOut(300);
        $(".ptable").fadeIn(300);
        $(".insightSignup").attr("href", "/signup?sub=4&coupon=TG50FIRST100")
        $(".competeSignup").attr("href", "/signup?sub=2&coupon=TG50FIRST100")
    });

    $(".js-monthly-table-btn").click(function(){
        $(".mcost").show();
        $(".ycost").hide();
        $(".js-yearly-table-btn").removeClass("active");
        $(".js-monthly-table-btn").addClass("active");
        $(".ptable").fadeOut(300);
        $(".ptable").fadeIn(300);
        $(".insightSignup").attr("href", "/signup?sub=3&coupon=TG50FIRST100")
        $(".competeSignup").attr("href", "/signup?sub=1&coupon=TG50FIRST100")
    });
    $('a.js-btn').click(function(e)
    {
      e.preventDefault();
    });
    //

        

        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
});

var cbpAnimatedHeader = (function() {
    var docElem = document.documentElement,
            header = document.querySelector( '.navbar-default' ),
            didScroll = false,
            changeHeaderOn = 200;
    function init() {
        window.addEventListener( 'scroll', function( event ) {
            if( !didScroll ) {
                didScroll = true;
                setTimeout( scrollPage, 250 );
            }
        }, false );
    }
    function scrollPage() {
        var sy = scrollY();
        if ( sy >= changeHeaderOn ) {
            $(header).addClass('navbar-scroll')
        }
        else {
            $(header).removeClass('navbar-scroll')
        }
        didScroll = false;
    }
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();

})();

// Activate WOW.js plugin for animation on scrol
new WOW().init();

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "position": "bottom"
})});
</script>

@endsection
