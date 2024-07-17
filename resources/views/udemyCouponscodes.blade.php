@extends('layouts.master')

@section('css')
<link href="{{ asset('assets/css/cookieconsent.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/freecourses.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="hero-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 hero-text">
				<h1 class="hero-head">Search Courses</h1>
        <div class="navy-line"></div>
      </div>
    </div>
  </div>
</section>	
<section class="filter-section">
	<div class="container">
   <form name="Myfomrs" id="Myfomrs" >
    <div class="row filter-row">

			<!-- <div class="col-md-6">
				<div class="select-site">
					<div class="form-group">
					      <label for="sel1" class="title-label">Select Free Course site</label>
					      <select class="form-control" id="sel1">
					        <option>Udemy</option>
					        <option>lorem</option>
					        <option>lorem</option>
					        <option>lorem</option>
					      </select>
				  	</div>
				</div>
			</div> -->


     <div class="col-md-6">
      <div class="i-checks"><label> <input id="chkCatAll" type="checkbox"> <i></i> All Categories</label></div>
      <div class="i-checks"><label> <input id="chkCatDev" type="checkbox"> <i></i> Development</label></div>
      <div class="i-checks"><label> <input id="chkCatBus" type="checkbox" value=""> <i></i> Business</label></div>
      <div class="i-checks"><label> <input id="chkCatITS" type="checkbox" value=""> <i></i> IT & Software</label></div>
      <div class="i-checks"><label> <input id="chkCatOff" type="checkbox" value=""> <i></i> Office Productivity</label></div>
      <div class="i-checks"><label> <input id="chkCatPer" type="checkbox" value=""> <i></i> Personal Development</label></div>
      <div class="i-checks"><label> <input id="chkCatDes" type="checkbox" value=""> <i></i> Design</label></div>
      <div class="i-checks"><label> <input id="chkCatMar" type="checkbox" value=""> <i></i> Marketing</label></div>
      <div class="form-group" id="data_1">

      </div>
    </div>
    <div class="col-md-6">
      <div class="i-checks"><label> <input id="chkCatLif" type="checkbox" value=""> <i></i> Lifestyle</label></div>
      <div class="i-checks"><label> <input id="chkCatPho" type="checkbox" value=""> <i></i> Photography</label></div>
      <div class="i-checks"><label> <input id="chkCatHea" type="checkbox" value=""> <i></i> Health & Fitness</label></div>
      <div class="i-checks"><label> <input id="chkCatTea" type="checkbox" value=""> <i></i> Teacher Training</label></div>
      <div class="i-checks"><label> <input id="chkCatMus" type="checkbox" value=""> <i></i> Music</label></div>
      <div class="i-checks"><label> <input id="chkCatAca" type="checkbox" value=""> <i></i> Academics</label></div>
      <div class="i-checks"><label> <input id="chkCatLan" type="checkbox" value=""> <i></i> Language</label></div>
      <div class="i-checks"><label> <input id="chkCatTes" type="checkbox" value=""> <i></i> Test Prep</label></div>
      
    </div>
  </form>
  <div class="row filter-row ajax-autocomplte-row">
    <div class="col-md-12"><label class="title-label">Filter</label></div>
    <div class="col-md-3">
     <div class="ui-widget">
       <label for="subcat">Search Subcategory: </label>
       <div class="form-group" id="selectSubCat">
        <div>
          <select id="selSubCat" data-placeholder="All Subcategories" class="select2_subcat form-control m-b" multiple="multiple" style="width:100%!important;"></select>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
   <div class="ui-widget">
     <label for="topic">Search Topic: </label>
     <div class="form-group" id="selectTopic">
      <div>
        <select id="selTopic" data-placeholder="All Topics" class="select2_topic form-control m-b" multiple="multiple" style="width:100%!important;"></select>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
 <div class="ui-widget">
   <label for="authors">Search Authors: </label>
   <div class="form-group" id="selectAuthor">
    <div>
      <select id="selAuthor" data-placeholder="All Author" class="select2_authors form-control" multiple="multiple"  style="width:100%!important;"></select>
    </div>
  </div>
</div>
</div>
<div class="col-md-3 add-keyword">
  <label for="authors">Add Keywords: </label>
  <div class="form-group" id="inputIncludeTags">
    <div class="col-md-10" style="padding: 0px;">
      <input id="includeTags" class="form-control tagsinput" type="text" placeholder="Enter Keywords"/>
    </div>
    <div class="col-md-2" id="tIncKeyRel" style="display:none">
      <input id="IncKeyRel" type="checkbox" checked data-toggle="toggle" data-on="or" data-off="and" data-onstyle="primary" data-offstyle="warning">
    </div>
  </div>
</div>
<div class="col-md-12">
<div class="col-md-3">
 <div class="ui-widget">
   <label for="authors">Max Price  </label>
   <div class="form-group" id="selectPrice">
    <div>
      <select id="selPrice" class="form-control" style="width:100%!important;">
      <option  value="" disabled="" selected="">Select price</option>
      <option  value="0" >0[free]</option>
      <option  value="10" ><=10$</option>
      <option  value="20" ><=20$</option>
      <option  value="30" > <=30$</option>
      <option  value="" >all</option>
     </select>
    </div>
  </div>
</div>
</div>
<div class="col-md-3">
 <div class="ui-widget">
   <label for="authors">Discount  </label>
   <div class="form-group" id="selectDiscount">
    <div>
      <select id="selDiscount" class="form-control" style="width:100%!important;">
      <option  value="" disabled="" selected="">Select Discount</option>
      <option  value="50" >>=50</option>
      <option  value="10" >>=80</option>
      <option  value="20" >>=90</option>
      <option  value="30" > >=95</option>
      <option  value="100" >>=100</option>
     </select>
    </div>
  </div>
</div>
</div>
</div>




</div>
<div class="result-row row">
  <div class="col-md-12">
    <label class="title-label">Search Result</label>
    <div class="table-responsive">
      <table class="result-table table-striped" id="coursetable">
        <thead>
          <tr>
            <th data-toggle="tooltip" title="tilte!">Title</th>
            <th data-toggle="tooltip" title="Subcategory!">Subcategory</th>
            <th data-toggle="tooltip" title="Topic!">Topic</th>
            <th data-toggle="tooltip" title="Duration!">Duration</th>
            <th data-toggle="tooltip" title="Rating!">Rating</th>
            <th data-toggle="tooltip" title="Review!">Review</th>
            <th data-toggle="tooltip" title="Students!">Students</th>
            <th data-toggle="tooltip" title="Code!">Coupon code</th>
            <th data-toggle="tooltip" title="Discount!">Discount %</th>
            <th data-toggle="tooltip" title="Price!">Price</th>
            <th data-toggle="tooltip" title="Link!">Link</th>
          </tr>
        </thead>
      </thead>
      <tbody id="course-info">
      </tbody>

    </table>
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
<!-- <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script> -->
<!-- <script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"d31b05e95c9687744ed6f3b65","lid":"7faa6cd4aa"}) })</script> -->
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>

<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
  <script src="/assets/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
<script>

  var table;
  var useCustomFilter;
  var customFilterID;
  
  $(document).ready(function(){

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

/////////////////// Search Start///////////////////////////////////////

$('.tagsinput').tagsinput({
  tagClass: 'label label-primary'
});
$('#selAuthor, #selTopic, #selSubCat,#selPrice, #selDiscount, #includeTags, #IncKeyRel,.i-checks').on('change', function(e) {
 MyserchFilter();
});
function MyserchFilter(){

  table=$('#coursetable').DataTable( {
    buttons: [],
    "responsive": true,
    "processing": true,
    "serverSide": true,
    "autoWidth": false,
    "bDestroy": true,
    "dom": '<"html5buttons"B>itlp',
    "ajax": {
      "url": "/api/searchudemycoupon",
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     "dataType": "json",
     "type": "GET",
     "data": function(d) {
      d._token = "{{ csrf_token() }}";
      d.cAll = $('#chkCatAll:checked').is(':checked');
      d.cDev = $('#chkCatDev:checked').is(':checked');
      d.cBus = $('#chkCatBus:checked').is(':checked');
      d.cITS = $('#chkCatITS:checked').is(':checked');
      d.cOff = $('#chkCatOff:checked').is(':checked');
      d.cPer = $('#chkCatPer:checked').is(':checked');
      d.cDes = $('#chkCatDes:checked').is(':checked');
      d.cMar = $('#chkCatMar:checked').is(':checked');
      d.cLif = $('#chkCatLif:checked').is(':checked');
      d.cPho = $('#chkCatPho:checked').is(':checked');
      d.cHea = $('#chkCatHea:checked').is(':checked');
      d.cTea = $('#chkCatTea:checked').is(':checked');
      d.cMus = $('#chkCatMus:checked').is(':checked');
      d.cAca = $('#chkCatAca:checked').is(':checked');
      d.cLan = $('#chkCatLan:checked').is(':checked');
      d.cTes = $('#chkCatTes:checked').is(':checked');
      d.Authors = $('#selAuthor').val();
      d.Topic = $('#selTopic').val();
      d.Price = $('#selPrice').val();
      d.Discount = $('#selDiscount').val();
      d.SubCat = $('#selSubCat').val();
      d.IncTags = $('#includeTags').val();
      d.IncKeyRel = $('#IncKeyRel').prop('checked');
     
    }
  },
  "columns": [
  {"data": "title"},
  {"data": "subcategory"},
  {"data": "topic"},
  {"data": "duration"},
  {"data": "rating"},
  {"data": "reviews"},
  {"data": "students"},
  {"data": "couponcode"},
  {"data": "discount"},
  {"data": "price"},
  {"data": "course_url"},

  ]
});


}

function setSelectedAuthor(authorSelect) {
  if ($('#author_id').val()) {
    var author = $('#author').val();
    var data = {
      id: $('#author_id').val(),
      text: $('#author').val()
    };
    var newOption = new Option(data.text, data.id, true, true);
    authorSelect.append(newOption).trigger('change');

            // manually trigger the `select2:select` event
            authorSelect.trigger({
              type: 'select2:select',
              params: {
                data: data
              }
            });
          }
        }

        function setSelectedTopic(topicSelect) {
          if ($('#topic_id').val()) {
            var topic = $('#topic').val();
            var data = {
              id: $('#topic_id').val(),
              text: $('#topic').val()
            };

            var newOption = new Option(data.text, data.id, true, true);
            topicSelect.append(newOption).trigger('change');

            // manually trigger the `select2:select` event
            topicSelect.trigger({
              type: 'select2:select',
              params: {
                data: data
              }
            });
          }
        }

        function setSelectedSubCat(subcatSelect) {
          if ($('#subcat_id').val()) {
            var subcat = $('#subcat').val();
            var data = {
              id: $('#subcat_id').val(),
              text: $('#subcat').val()
            };

            var newOption = new Option(data.text, data.id, true, true);
            subcatSelect.append(newOption).trigger('change');

            // manually trigger the `select2:select` event
            subcatSelect.trigger({
              type: 'select2:select',
              params: {
                data: data
              }
            });
          }
        }


        $('.select2_authors').select2({
          placeholder: "All Authors",
          minimumInputLength: 2,
          ajax: {
            url: '/api/searchauthors',
            dataType: 'json',
            data: function (params) {
              return {
                q: $.trim(params.term)
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
        setSelectedAuthor($('.select2_authors'));

        $('.select2_topic').select2({
          placeholder: "All Topics",
          minimumInputLength: 1,
          ajax: {
            url: '/api/searchtopics',
            dataType: 'json',
            data: function (params) {
              return {
                q: $.trim(params.term)
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
        setSelectedTopic($('.select2_topic'));

        $('.select2_subcat').select2({
          placeholder: "All Subcategories",
          minimumInputLength: 1,
          ajax: {
            url: '/api/searchsubcats',
            dataType: 'json',
            data: function (params) {
              return {
                q: $.trim(params.term)
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
        setSelectedSubCat($('.select2_subcat'));


/////////////////////////////////////////////end////////////////

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