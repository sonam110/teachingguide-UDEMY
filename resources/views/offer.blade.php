@extends('layouts.landing')

@section('css')
<link href="{{ asset('assets/css/home.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/lp_style.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<div class="background-part">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="investor_title text-center">
                   <h1><strong>TOP 5 METHODS FOR GROWING UDEMY COURSES</strong></h1>
                   <h4>We at Teachinguide provide competitive information for an online instructor to succeed on Udemy and other learning platforms.</h4>
               </div>
           </div>
       </div>
       <div class="row freebook">
           <div class="col-sm-6 col-md-4">
               <div class="left_bk_side_txt">
                   <h4><strong>Why you need this book?</strong></h4>
                   <p><i class="fa fa-check"></i> <span>Rеѕеаrсh аnd Dесidе оn the Right Course Tорiс.</span></p>
                   <p><i class="fa fa-check"></i> <span>Understand How Udemy Rаnkѕ Courses.</span></p>
                   <p><i class="fa fa-check"></i> <span>Crеаtе a high Quality Cоurѕе thаt Engаgеѕ and Sells.</span></p>
                   <p><i class="fa fa-check"></i> <span>Optimize your Course Pricing and Listing.</span></p>
                   <p><i class="fa fa-check"></i> <span>Promote Yоur Course Strаtеgiсаllу.</span></p>
               </div>
           </div>
           <div class="col-sm-6 col-md-4 transparent_box">
               <div class="left_bk_side"> <img src="{{ asset('assets/img/books.png') }}" class="img-responsive" /></div>
           </div>
           <div class="col-sm-12 col-md-4">
               <div class="left-contact-form">
                   <div class="contact-forms">
                       <form id="contact" method="POST" action="{{ route('getoffer') }}">
                         @csrf
                           <h3 class="text-center">Get your free eBook on how to succeed on Udemy</h3>
                           <div class="form-group">
                               <input type="text" class="form-control" name="name" placeholder="Your Name" required >
                           </div>
                           <div class="form-group">
                               <input type="email" class="form-control" name="email" placeholder="Enter Email" required >
                           </div>
                           <center>
                               <button name="btnSubmit" type="submit"><i class="fa fa-cloud-download" aria-hidden="true"></i> Get the ebook</button>
                           </center>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
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
<!-- <footer>
 <div class="footer_inner text-center">
     <div class="container">
         <div class="footer_logo">
             <a href="/"><img src="{{ asset('assets/img/logo/logo_white.svg') }}"></a>
         </div>
         <div class="copyrights">
             <p>&copy; 2018 TeachinGuide</p>
         </div>
     </div>
 </div>
</footer> -->
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/validate/jquery.validate.min.js') }}"></script>

<script  type="text/javascript">
    $(document).ready(function () {

        @if (App::environment() == "production")
          fbq('track', 'Lead');
        @endif
    });

    var form = jQuery("#contact");
    var validator = form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {}
    });

    var form = document.getElementById('contact');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var errorCount = validator.numberOfInvalids();

      if (errorCount > 0) {
          console.log("error");
          return false;
      }
      fbq('track', 'NLSignup');

      form.submit();
    });
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
        var cbpAnimatedHeader = (function() {
          var docElem = document.documentElement,
                  header = document.querySelector( '.navbar-default' ),
                  didScroll = false,
                  changeHeaderOn = 100;
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
                  $(header).removeClass('navbar-scroll');
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

@endsection
