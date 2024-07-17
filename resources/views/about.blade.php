@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/css/cookieconsent.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/about.css') }}" rel="stylesheet" />
@endsection

@section('content')	
<section class="our-misson-vision">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="our-mission">
					<div class="section-title">
						<h1>Our Mission:</h1>
						<!-- <h3>Lorem ipsum eget mi act</h3> -->
						<div class="navy-line"></div>
					</div>
					<div class="mission-content common-content">
						<h2>TO HELP YOU BUILD A PROFITABLE<br> ONLINE COURSE BUSINESS</h2>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="our-vision">
					<div class="section-title">
						<h2>Online Instructors</h2>
						<h2>Course Companies</h2>
						<h2>Online Entrepreneurs</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="our-leader-section">
	<div class="container">
		<div class="container">
			<div class="section-title">
				<h2>Empowering The Online Instructor</h2>
				<h3>SUCCEED FROM DAY 1</h3>
				<div class="navy-line"></div>
			</div>
			<div class="row leader-row">
				<div class="col-md-4">
					<div class="leader-img">
						<img src="/assets/img/teach_community.jpg">
					</div>
				</div>
				<div class="col-md-8">
					<div class="leader-content">
						<h4>Teaching the community</h4>
						<p>Your mission is to teach students. So is ours! Learn from past failures and best practices that make other instructor successful.</p>
						<p>We help you to get started the right way, have all information required to lay the foundation for a very profitable course business.</p>
					</div>
				</div>
			</div>
			<div class="row leader-row">
				<div class="col-md-8">
					<div class="leader-content left-leader-content">
						<h4>Data and Analytics Driven</h4>
						<p>We know that the right information at the right time will give you huge competitive advantages.</p>
						<p>So we fully utilize our core competencies in data integration and data science to keep you ahead.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="leader-img">
						<img src="/assets/img/data_science.jpg">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--
<section class="our-team-section">
	<div class="container">
		<div class="row">
			<div class="section-title">
				<h2>Our Team</h2>
				<div class="navy-line"></div>
				<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tempor nisl sapien, sed porttitor augue tristique sed. Maecenas vitae arcu at lacus aliquet auctor. Duis facilisis blandit mi non porta. Nam finibus ipsum quam, eu finibus justo aliquet eget.</h3>
			</div>
			<div class="team-slider">
				<div class="col-md-12 col-centered">
					<div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
						<div class="carousel-inner">
							<div class="item active">
								<div class="carousel-col">
									<div class="block">
										<img src="/assets/img/p6.jpg">
										<div class="block-text">
											<p class="team-name">Lorem ipsum</p>
											<p class="team-content">Lorem</p>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="carousel-col">
									<div class="block">
										<img src="/assets/img/p5.jpg">
										<div class="block-text">
											<p class="team-name">Lorem ipsum</p>
											<p class="team-content">Lorem</p>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="carousel-col">
									<div class="block">
										<img src="/assets/img/p3.jpg">
										<div class="block-text">
											<p class="team-name">Lorem ipsum</p>
											<p class="team-content">Lorem</p>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="carousel-col">
									<div class="block">
										<img src="/assets/img/p2.jpg">
										<div class="block-text">
											<p class="team-name">Lorem ipsum</p>
											<p class="team-position">Lorem</p>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="carousel-col">
									<div class="block">
										<img src="/assets/img/p4.jpg">
										<div class="block-text">
											<p class="team-name">Lorem ipsum</p>
											<p class="team-position">Lorem</p>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Controls -->
						<div class="left carousel-control">
							<a href="#carousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
						</div>
						<div class="right carousel-control">
							<a href="#carousel" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
-->
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

<!-- team slider js -->
<script>
	$('.carousel[data-type="multi"] .item').each(function() {
		var next = $(this).next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo($(this));

		for (var i = 0; i < 2; i++) {
			next = next.next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}

			next.children(':first-child').clone().appendTo($(this));
		}
	});
</script>
@endsection