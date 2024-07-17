@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/css/cookieconsent.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/coursedatabase.css') }}" rel="stylesheet" />
@endsection

@section('content')
<section class="hero-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 hero-text">
				<h1 class="hero-head">Go From Course Data to Profits in a Fraction of Time</h1>
				<h2 class="hero-sub-head">The Course Database gives you the power to scan Udemy’s course catalog instantly – so you can spend more time on your business and less time doing research</h2>
				<a href="{{ route('product') }}" class="hero-btn">Try Free Now</a>
			</div>
			<div class="col-md-6 hero-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/C6cqwmXkF7Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</section>
<section class="hero-below-section">
	<div class="container">
		<div class="row hero-below-content">
                <div class="col-md-6">
                    <div class="hero-below-image">
                        <img src="/assets/img/p4.jpg">
                    </div>
                </div>
    			<div class="col-md-6 hero-below-content-row">
    				   <div class="hero-below-head">Your secret weapon to making smarter online course decisions.</div>
    				   <div class="hero-below-sub-head">Outpace the competition before and after you launch your course business</div>				
    			</div>
		</div>
	</div>
</section>
<section class="benifit-section">
	<div class="container">
		<div class="benifit-section-content">
			<div class="navy-line"></div>
				    <h2 class="benifit-head">The Benefits in Details</h2>
				    <div class="row">
				    	<div class="col-md-6 detail-box-row">
				    		<div class="detail-box">
				    			<div class="row">
				    				<div class="col-xs-1 detail-icon">
				    					<i class="fa fa-database" aria-hidden="true"></i>
				    				</div>
				    				<div class="col-xs-11 detail-text">
				    					<div class="benifit-title">Complete Course Database</div>
				    					<div class="benifit-detail">The complete online course catalog with over 60k courses, transparent at your finger tips. Designed for course instructors for easy filtering and in depth analysis.</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="col-md-6 detail-box-row">
				    		<div class="detail-box">
				    			<div class="row">
				    				<div class="col-xs-1 detail-icon">
				    					<i class="fa fa-database" aria-hidden="true"></i>
				    				</div>
				    				<div class="col-xs-11 detail-text">
				    					<div class="benifit-title">Course Sales Data and Trends</div>
				    					 <div class="benifit-detail">Know where your efforts are worth while to create online courses. Get real student enrollment data and trend information to understand topic demand in all categories, topics and for many other criteria.</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="col-md-6 detail-box-row">
				    		<div class="detail-box">
				    			<div class="row">
				    				<div class="col-xs-1 detail-icon">
				    					<i class="fa fa-database" aria-hidden="true"></i>
				    				</div>
				    				<div class="col-xs-11 detail-text">
				    					<div class="benifit-title">Course Competitiveness Metrics </div>
				    					 <div class="benifit-detail">Give yourself the chance to win. Get crucial insights on your course competition with metrics like engagement, ratings, run promotions, keywords ranking power or CLP backlink power.</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="col-md-6 detail-box-row">
				    		<div class="detail-box">
				    			<div class="row">
				    				<div class="col-xs-1 detail-icon">
				    					<i class="fa fa-database" aria-hidden="true"></i>
				    				</div>
				    				<div class="col-xs-11 detail-text">
				    					<div class="benifit-title">Instant and unlimited data exports</div>
				    					 <div class="benifit-detail">Export any views on the course database including all demand and competitive metrics for further analysis.</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	<div class="col-md-6 detail-box-row">
				    		<div class="detail-box">
				    			<div class="row">
				    				<div class="col-xs-1 detail-icon">
				    					<i class="fa fa-database" aria-hidden="true"></i>
				    				</div>
				    				<div class="col-xs-11 detail-text">
				    					<div class="benifit-title">Easy Filtering and flexible Views</div>
				    					 <div class="benifit-detail">Get the data you need. Filter by category, subcategory, topic, instructor, badge, pricing, ranks, sales, keyword combinations and many more. Select the metrics you need.</div>
				    				</div>
				    			</div>
				    		</div>
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
              <a href="{{ route('newsletter') }}">Newsletter</a>

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
            $(header).addClass('navbar-scroll');
            $(".navbar-wrapper").addClass("navbar-wrapper-top");
        }
        else {
            $(header).removeClass('navbar-scroll')
            $(".navbar-wrapper").removeClass("navbar-wrapper-top");
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