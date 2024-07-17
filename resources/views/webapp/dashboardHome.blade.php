@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="btn-group">
      <h2 class="webapp-header">Home Dashboard</h2>
  </div>
  <div class="btn-group pull-right">
      <div class="pull-right webapp-header">
          <a href="#" class="btn btn-info startTour"><i class="fa fa-play"></i> Start Tour</a>
      </div>
  </div>
</div>

<div class="row wrapper">
    <div class="col-lg-4">
        <div class="ibox float-e-margins" id="ttgStatus">
            <div class="ibox-title">
                <h5>TeachinGuide Status</h5>
            </div>
            <div class="ibox-content">
                Teachinguide is live in its first version now and includes <strong>english</strong> speaking courses only.
                </br></br>
                Please be aware that functionality and data might be changing quickly ot enhance the experience.
                </br></br>
                Your feedback is essential to us and the overall platform quality. So please us the feedback functionality to indicate any errors, problems and improvement opportunities.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins" id="tdataStatus">
            <div class="ibox-title">
                <h5>Data Status</h5>
            </div>
            <div class="ibox-content">
                <span id="datastatus"></span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox float-e-margins"  id="tsubStatus">
            <div class="ibox-title">
                <h5>Subscription Status</h5>
            </div>
            <div class="ibox-content">
                <span id="substatus"></span>
            </div>
        </div>

    </div>
</div>

<div class="row wrapper" id="tnavTiles">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Dashboards</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="/dashboard" class="btn btn-primary dim btn-large-dim"type="button">
                                    <p style="font-size: 14px; margin: 0;">Home</p>
                                    <i class="fa fa-dashboard" style=""></i>
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <a href="/course-monitor" class="btn btn-primary dim btn-large-dim"type="button">
                                    <p style="font-size: 14px; margin: 0;">Monitor</p>
                                    <i class="fa fa-line-chart" style=""></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Insights</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="/course-search" class="btn btn-primary dim btn-large-dim"type="button">
                                    <p style="font-size: 14px; margin: 0;">Courses</p>
                                    <i class="fa fa-graduation-cap"></i>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="/topic-search" class="btn btn-primary dim btn-large-dim"type="button">
                                    <p style="font-size: 14px; margin: 0;">Topics</p>
                                    <i class="fa fa-comment-o"></i>
                                </a>
                            </div>
                            <div class="col-xs-4">
                                <a href="/author-search" class="btn btn-primary dim btn-large-dim"type="button">
                                    <p style="font-size: 14px; margin: 0;">Authors</p>
                                    <i class="fa fa-address-book"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Compete</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <a href="/keyword-search" class="btn btn-primary dim btn-large-dim"type="button">
                            <p class="text-center" style="font-size: 14px; margin: 0;">Keywords</p>
                            <i class="fa fa-signal"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row wrapper">
  </br>
</div>

<div class="row wrapper">
    <div class="col-lg-4">
        <div class="ibox-content" id="tNewStudents">
            <h5>New Student Enrollments</h5>
            <h2 id="lastEnrollments">0</h2>
            <div id="sparkline1">
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox-content" id="tnewCourses">
            <h5>New Courses</h5>
            <h2 id="lastCourses">0</h2>
            <div id="sparkline2">

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox-content" id="tlastReviews">
            <h5>New Reviews</h5>
            <h2 id="lastReviews">0</h2>
            <div id="sparkline3">

            </div>
        </div>
    </div>
</div>

<div class="row wrapper">
  </br>
</div>

<div class="row wrapper">
    <div class="col-lg-2">
        <div class="ibox-content" id="ttopSubCat">
            <h5>Top 10 Subcategories</h5>
            <table class="table table-stripped small m-t-md">
                <tbody id="top3Subcategories">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox-content" id="ttopTopics">
            <h5>Top 10 Topics</h5>
            <table class="table table-stripped small m-t-md">
                <tbody id="top3topics">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="ibox-content" id="ttopCourses">
            <h5 style="margin: 0;display: inline-block;">Top 10 Courses</h5>
            <span style="float: right !important;">
                <input id="toggleFreeCourses" type="checkbox" checked data-toggle="toggle" data-on="Free" data-off="Paid" data-onstyle="primary" data-offstyle="warning">
            </span>
            <table class="table table-stripped small m-t-md">
                <tbody id="top3courses">
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="ibox-content" id="ttopKeywords">
            <h5 style="margin: 0;display: inline-block;">Top 10 Keywords</h5>
            <span style="float: right !important;">
                <input id="toggleFreeKeywords" type="checkbox" checked data-toggle="toggle" data-on="Free" data-off="Paid" data-onstyle="primary" data-offstyle="warning">
            </span>
            <table class="table table-stripped small m-t-md">
                <tbody id="top3keywords">
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/webapp/homeDashboard_tour.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>


<script>

    $(document).ajaxError(function(event, jqxhr, settings, exception) {
        if (exception == 'Unauthorized' || exception == 'unknown status') {
            bootbox.confirm("Your session has expired. Would you like to be redirected to the login page?", function(result) {
                if (result) {
                    window.location = '/login';
                }
            });
        }
    });

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){

        $('#toggleFreeKeywords').bootstrapToggle({
            width: '200px'
        });

        $.get("/api/dashboard-status", function(data, status){
              $("#datastatus").html(data);
        });
        $.get("/api/sub-status", function(data, status){
              $("#substatus").html(data);
        });

        $.get("/api/dashboard-students", function(data, status){
          var b = data.split(',').map(Number);
          $("#sparkline1").sparkline(b, {
             type: 'line',
             width: '100%',
             height: '60',
             lineColor: '#1ab394',
             fillColor: "#ffffff"
          });
          var lastVal = b[b.length-1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          $("#lastEnrollments").text(lastVal);
        });

        $.get("/api/dashboard-courses", function(data, status){
          var b = data.split(',').map(Number);
          $("#sparkline2").sparkline(b, {
             type: 'line',
             width: '100%',
             height: '60',
             lineColor: '#1ab394',
             fillColor: "#ffffff"
          });
          var lastVal = b[b.length-1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          $("#lastCourses").text(lastVal);
        });

        $.get("/api/dashboard-reviews", function(data, status){
          var b = data.split(',').map(Number);
          $("#sparkline3").sparkline(b, {
             type: 'line',
             width: '100%',
             height: '60',
             lineColor: '#1ab394',
             fillColor: "#ffffff"
          });
          var lastVal = b[b.length-1].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          $("#lastReviews").text(lastVal);
        });

        $.get("/api/dashboard-topsubcategories", function(data, status){
              $("#top3Subcategories").html(data);
        });

        $.get("/api/dashboard-topcourses", function(data, status){
              $("#top3courses").html(data);
        });

        $.get("/api/dashboard-toptopics", function(data, status){
              $("#top3topics").html(data);
        });

        $.get("/api/dashboard-topkeywords", function(data, status){
              $("#top3keywords").html(data);
        });
    });
    $('#toggleFreeKeywords').on('change', function(){
        var paid = $('#toggleFreeKeywords').prop('checked') ? 1 : 0;
        $.get("/api/dashboard-topkeywords?paid=" + paid, function(data, status){
              $("#top3keywords").html(data);
        });
    });
    $('#toggleFreeCourses').on('change', function(){
        var paid = $('#toggleFreeCourses').prop('checked') ? 1 : 0;
        $.get("/api/dashboard-topcourses?paid=" + paid, function(data, status){
              $("#top3courses").html(data);
        });
    });


</script>
@endsection
