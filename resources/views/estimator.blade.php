@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/css/cookieconsent.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/estimator.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="main_etimator">
   <div class="container">
      <div class="row">
         <div class="title">
            <h1>Udemy Sales Estimator</h1>
            </br></br>
            <p>Our Estimator is an easy way to check average monthly sales for specific Udemy courses, instructors or even specific keywords. Start to understand your potential and a simple way to spy on your competitors..</p>
         <keyworddiv>
      </div>
   </div>
</section> 

<section class="main_etimator_tabs">
   <div class="container">

     <ul class="nav nav-tabs">
       <li class="active"><a href="#course">Course</a></li>
       <li><a href="#instructor">Instructor</a></li>
       <li><a href="#keyword">Keyword</a></li>
     </ul>

     <div class="tab-content custom-tab-content">
       <div id="course" class="tab-pane fade in active">
         <div class="row">
            <div class="col-md-4">
                <h2 title="Hooray!">Estimated Number of Sales per Month</h2>
            </div>
            <div class="col-md-8">
                <div class="course-estimate-result"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <p class="top-p">Get an estimate on monthly student enrollment for a specific course</p>
            </div>
            <div class="col-md-3">
               <label data-tooltip="Start typing the course title or just paste a course landing page url.">Course-Title / Course-URL <i class="fa fa-question-circle  js-question-mark" aria-hidden="true"></i></label>
            </div>
            <div class="col-md-9">
               <select id="selCourse" name="selCourse" data-placeholder="Search Course by typing or pasting course-url" class="select2_course form-control m-b" value="" style="width:100%!important;"></select>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <div class="btn estimate-btn"> 
                <button id="getcourseestimate" class="estimate-submit" disabled>Estimate sales!</button>
              </div>
            </div>
         </div>
       </div>

       <div id="instructor" class="tab-pane fade">
         <div class="row">
            <div class="col-md-4">
                <h2 title="Hooray!">Estimated Number of Sales per Month</h2>
            </div>
            <div class="col-md-8">
                <div class="instructor-estimate-result"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <p class="top-p">Get an estimate on monthly student enrollment for a specific Udemy instructor.</p>
            </div>
            <div class="col-md-3">
               <label data-tooltip="Start typing the instructor name.">Author-Name <i class="fa fa-question-circle  js-question-mark" aria-hidden="true"></i></label>
            </div>
            <div class="col-md-9">
                <select id="selInstructor" name="selInstructor" data-placeholder="Search Author by Name" class="select2_instructor form-control m-b" value="" style="width:100%!important;"></select>
            </div>
         </div>
          <div class="row">
            <div class="col-md-12">
              <div class="btn estimate-btn">     
                <button id="getinstructorestimate" class="estimate-submit">Estimate sales!</button>
              </div>
            </div>
          </div>
       </div>

        <div id="keyword" class="tab-pane fade">
          <div class="row">
            <div class="col-md-4">
                <h2 title="Hooray!">Estimated Number of Sales per Month</h2>
            </div>
            <div class="col-md-8">
                <div class="keyword-estimate-result"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
              <p class="top-p">Get an estimate on monthly student enrollment for the top ranked course on a keyword.</p>
            </div>
            <div class="col-md-3">
               <label data-tooltip="Start typing the keyword.">Keyword <i class="fa fa-question-circle  js-question-mark" aria-hidden="true"></i></label>
            </div>
            <div class="col-md-9">
               <select id="selKeyword" name="selKeyword" data-placeholder="Search Keyword" class="select2_keyword form-control m-b" value="" style="width:100%!important;"></select>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
                <div class="btn estimate-btn">     
                    <button id="getkeywordestimate" class="estimate-submit">Estimate sales!</button>
                </div>
            </div>
         </div>
       </div>
     </div>
   </div>
</section>

<section id="needmore" style="margin-bottom:60px;">
    <div class="row">
      <div class="container">
          <div class="col-lg-12 text-center" style="margin-bottom:30px;">
              <div class="navy-line"></div>
          </div>
      </div>
    </div>

    <div class="row padding-bottom-60">
        <div class="container">
          <div class="col-lg-6 wow fadeInLeft">
              <h1><strong>Need more data?</strong></h1>
              <p>There are so much more insights you can gain into Udemy course-level data with advanced competitive research. The Teachinguide Web App is an exceptional tool built for Udemy course instructors to provide the right data you need to become a successful online instructor.</p>
              <p style="margin-bottom:30px"><a class="page-scroll btn btn-primary insicon tryfreebtn" href="{{ route('product') }}" role="button">Get Started &raquo;</a></p>
          </div>
          <div class="col-md-6 text-center wow fadeInRight">
              <div class="videoWrapper">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/9-Hyknr0HrQ?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
                <p>We at teachinguide provide competitive information for online keywords to succeed on Udemy and other learning platforms. </p>
                </brkeyword
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
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>

<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"d31b05e95c9687744ed6f3b65","lid":"7faa6cd4aa"}) })</script>
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


<script>
$(document).ready(function () {

    @if (App::environment() == "production")
      fbq('track', 'ViewEstimator');
    @endif

});
</script>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $(document).ready(function() {
     $(document).on("click", "ul.prod-gram .init", function() {
       $(this).parent().find('li:not(.init)').toggle();
     });
     var allOptions = $("ul.prod-gram").children('li:not(.init)');
     $("ul.prod-gram").on("click", "li:not(.init)", function() {
       allOptions.removeClass('selected');
       $(this).addClass('selected');
       $(this).parent().children('.init').html($(this).html());
       $(this).parent().find('li:not(.init)').toggle();
     });
   });
});
</script>

<script>
    var toolTipSelector = ".js-tool-tip";
    var toolTipClass = "js-tool-tip";
    var cssObj = {};
    $("body").on("mouseenter mouseleave", "label[data-tooltip]", function(e){
        if(e.type == "mouseenter"){
            var $theQuestionMark = $(this).find(".js-question-mark");
            // Hover over code
            var theToolTipText = $(this).attr('data-tooltip');
            if(theToolTipText.length > 0){
                let $theToolTipObj = $("<p class='"+toolTipClass+"'></p>")
                .html(theToolTipText)
                .appendTo(this);
                cssObj['top'] = $theQuestionMark.position().top - $theToolTipObj.height() - 25;
                cssObj['left'] = $theQuestionMark.position().left  - ($theToolTipObj.width()/2 + 10);
                $theToolTipObj.css(cssObj)
                $theToolTipObj.fadeIn('fast');
            }
        } else if(e.type == "mouseleave"){
            $(toolTipSelector).remove();
            cssObj = {};
        }
    });
</script>

<script> 
  //for courses
  $('.select2_course').select2({
      placeholder: "Search Course by typing or pasting course-url.",
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('searchCourseByName') }}',
          dataType: 'json',
          data: function (params) {
              var query = $.trim(params.term).replace('http://www.', '').replace('https://www.', '');
              return {
                  q: query
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
  });

  $('.select2_course').on('select2:select', function (e) {
      $("#getcourseestimate").removeAttr('disabled');
  });

  $("#getcourseestimate").click(function(){
      var course_id = $('#selCourse').val();
      $.get("/papi/course-sales-estimate?course_id="+course_id, function(data, status){
          var el = $('.course-estimate-result');
          var sales = data.sales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var html = '<p>"' + data.title + '" - by '+ data.author;
          html = html + '</br><strong>~' + sales + '*</strong> students per month for a current price of $' + data.price + '.</p>';
          html = html + '<small>*based on current data including promotions</small>';
          el.html(html);
          el.fadeIn();
      });
  });
</script>

<script> 
  //for instructors
  $('.select2_instructor').select2({
      placeholder: "Search Instructor by Name.",
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('searchInstructorByName') }}',
          dataType: 'json',
          data: function (params) {
              var query = $.trim(params.term).replace('http://www.', '').replace('https://www.', '');
              return {
                  q: query
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
  });

  $('.select2_instructor').on('select2:select', function (e) {
      $("#getinstructorestimate").removeAttr('disabled');
  });

  $("#getinstructorestimate").click(function(){
      var instructor_id = $('#selInstructor').val();
      $.get("/papi/instructor-sales-estimate?instructor_id="+instructor_id, function(data, status){
          var el = $('.instructor-estimate-result');
          var sales = data.sales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var html = '<p>"' + data.name + '"';
          html = html + '</br><strong>~' + sales + '*</strong> students per month for ' + data.course_count + ' courses on Udemy.</p>';
          html = html + '<small>*based on current data including promotions</small>';
          el.html(html);
          el.fadeIn();
      });
  });
</script>

<script> 
  //for keywords
  $('.select2_keyword').select2({
      placeholder: "Search Keyword.",
      minimumInputLength: 2,
      ajax: {
          url: '{{ route('searchKeyword') }}',
          dataType: 'json',
          data: function (params) {
              var query = $.trim(params.term).replace('http://www.', '').replace('https://www.', '');
              return {
                  q: query
              };
          },
          processResults: function (data) {
              return {
                  results: data
              };
          },
          cache: true
      }
  });

  $('.select2_keyword').on('select2:select', function (e) {
      $("#getkeywordestimate").removeAttr('disabled');
  });

  $("#getkeywordestimate").click(function(){
      var keyword_id = $('#selKeyword').val();
      $.get("/papi/keyword-sales-estimate?keyword_id="+keyword_id, function(data, status){
          var el = $('.keyword-estimate-result');
          var sales = data.sales.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var html = '<p>"' + data.title + '" (by '+ data.author +')';
          html = html + '</br><strong>~' + sales + '*</strong> students per month for a current price of $' + data.price + '.</p>';
          el.html(html);
          el.fadeIn();
      });
  });
</script>


@endsection