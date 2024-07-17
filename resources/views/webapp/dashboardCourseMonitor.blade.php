@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/webapp/webapp.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<?php use App\Http\Controllers\MemberController;?>

<div class="row wrapper border-bottom white-bg page-heading" id="tStart">
    <div class="btn-group">
        <h2 class="webapp-header">Course Monitor</h2>
    </div>
    <div class="btn-group pull-right">
        <div class="pull-right webapp-header">
            <a href="#" class="btn btn-info startTour"><i class="fa fa-play"></i> Start Tour</a>
            <a href="/dashboard" class="btn btn-default">Dashboard</a>
        </div>
    </div>
</div>
  
<div class="row wrapper">
      <div class="tabs-container">
          <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab-1">Courses</a></li>
              <li class="" id><a data-toggle="tab" href="#tab-2">Columns</a></li>
              <li><a data-toggle="tab" type="button" id="apifyWebhook"> <i class="fa fa-refresh"></i> Refresh</a></li>


          </ul>
          <div class="tab-content">
              <div id="tab-1" class="tab-pane active">
                  <div class="ibox float-e-margins" id="ibox1">

                      <div class="ibox-content">
                          <div class="sk-spinner sk-spinner-double-bounce">
                              <div class="sk-double-bounce1"></div>
                              <div class="sk-double-bounce2"></div>
                          </div>
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="btn-group webapp-header" id="tSearch">
                                      <select id="selCourse" name="selCourse" data-placeholder="Search Course by typing or pasting course-url" class="select2_course form-control m-b" value="" style="width:100%!important;"></select>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="btn-group pull-right">
                                      <div class="pull-right webapp-header" id="tAddDelete">
                                          <button id="delCourseBtn" class="btn btn-secondary" disabled>Delete</button>
                                          <button id="addCourseBtn" class="btn btn-primary" disabled>Add Course</button>
                                      </div>
                                  </div>
                              </div>
                            </div>

                      </div>
                  </div>
              </div>
              <div id="tab-2" class="tab-pane">
                  <div class="panel-body">
                      <div class="col-md-12">
                          <a class="toggle-vis lead" data-column="0">Title</a> -
                          <a class="toggle-vis " data-column="1">Subcategory</a> -
                          <a class="toggle-vis lead" data-column="2">Sub. Cat. Rank</a> -
                          <a class="toggle-vis " data-column="3">Price</a> -
                          <a class="toggle-vis " data-column="4">Badge</a> -
                          <a class="toggle-vis lead" data-column="5">Author</a> -
                          <a class="toggle-vis lead" data-column="6">Topic</a> -
                          <a class="toggle-vis lead" data-column="7">Rating</a> -
                          <a class="toggle-vis lead" data-column="8">Students</a> -
                          <a class="toggle-vis lead" data-column="9">Reviews</a> -
                          <a class="toggle-vis " data-column="10">Engagement</a> -
                          <a class="toggle-vis lead" data-column="11">New Students</a> -
                          <a class="toggle-vis lead" data-column="12">Promo</a> -
                          <a class="toggle-vis " data-column="13">KWRP</a> -
                          <a class="toggle-vis " data-column="14">BLP</a> -
                          <a class="toggle-vis lead" data-column="15">Trend</a> -
                          <a class="toggle-vis " data-column="16">Last Update</a> -
                          <a class="toggle-vis lead" data-column="17">Udemy Link</a>
                          <a class="toggle-vis" data-column="18">Status</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</div>

<div class="row wrapper">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Monitored Courses (max {{ MemberController::hasCompete() ? 20 : 5}} courses)</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="table-responsive table-tooltips" id="tMonitorTable">
                <table id="coursetable" class="table table-stripped display responsive">
                    <thead>
                        <tr>
                            <th data-toggle="tooltip">Title</th>
                            <th data-toggle="tooltip">Subcategory</th>
                            <th data-toggle="tooltip">Sub. Cat. Rank</th>
                            <th data-toggle="tooltip">Price</th>
                            <th data-toggle="tooltip">Badge</th>
                            <th data-toggle="tooltip">Author</th>
                            <th data-toggle="tooltip">Topic</th>
                            <th data-toggle="tooltip">Rating</th>
                            <th data-toggle="tooltip">Students</th>
                            <th data-toggle="tooltip">Reviews</th>
                            <th data-toggle="tooltip">Engagement</th>
                            <th data-toggle="tooltip">New Students</th>
                            <th data-toggle="tooltip">Promo</th>
                            <th data-toggle="tooltip">KWRP</th>
                            <th data-toggle="tooltip">BLP</th>
                            <th data-toggle="tooltip">Trend</th>
                            <th data-toggle="tooltip">Last Update</th>
                            <th data-toggle="tooltip">Udemy</th>
                            <th data-toggle="tooltip">Status</th>

                        </tr>
                    </thead>
                    <tbody id="course-info">
                    </tbody>
                    <tfoot>
                      <tr>
                          <td colspan="1">
                              <ul class="pagination pull-right"></ul>
                          </td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row wrapper">
  <div class="col-lg-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title" id="tCourseChart">
            <h5 id="chartTitle">Student enrollments - 2018 (CW23 - CW32)</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="flot-chart">
                <div class="flot-chart-content" id="flot-line-chart"></div>
            </div>
        </div>
    </div>
    <div class="ibox float-e-margins">
        <div class="ibox-title" id="tRatingChart">
            <h5 id="ratingChartTitle">Ratings over time - 2018 (CW23 - CW32)</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-bar-chart"></div>
                </div>
        </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="ibox float-e-margins" id="tKWRanking">
        <div class="ibox-title">
            <h5>Last Keyword Ranking Positions</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive table-tooltips">
                <table id="rankingtable" class="table table-stripped display responsive">
                <thead>
                <tr>
                    <th data-toggle="tooltip">Keyword</th>
                    <th data-toggle="tooltip">Topic</th>
                    <th data-toggle="tooltip">Rank</th>
                    <th data-toggle="tooltip">Change</th>
                    <th data-toggle="tooltip">Date</th>
                    <th data-toggle="tooltip">Traffic</th>
                </tr>
                </thead>
                <tbody id="ranking-info">
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="1">
                        <ul class="pagination pull-right"></ul>
                    </td>
                </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="row wrapper">
    <div class="col-lg-12">
        <div class="ibox float-e-margins" id="tBacklinks">
            <div class="ibox-title">
                <h5 id="blTableTile">Backlinks for Course Landing Page</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive table-tooltips">
                    <table id="backlinktable" class="table table-stripped display responsive">
                    <thead>
                    <tr>
                        <th data-toggle="tooltip">Link</th>
                        <th data-toggle="tooltip">UR</th>
                        <th data-toggle="tooltip">DR</th>
                        <th data-toggle="tooltip">Domains</th>
                        <th data-toggle="tooltip">BL</th>
                        <th data-toggle="tooltip">Ext</th>
                        <th data-toggle="tooltip">Int</th>
                        <th data-toggle="tooltip">Traffic</th>
                        <th data-toggle="tooltip">KW</th>
                        <th data-toggle="tooltip">Type</th>
                        <th data-toggle="tooltip">Age</th>
                    </tr>
                    </thead>
                    <tbody id="backlink-info">
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="1">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
right plan to see?
-->
<div class="secoverlay" hidden>
    </br></br>
    <h2 class='md-display-4'>Insight or Compete - Subscription</h2>
    <a class="caption-link trbg" href="/account" role="button">Upgrade Now</a>
    @if(!empty(Auth::user()->trial_ends_at))
    <a class="caption-link affiliate-link trbg" href="/account?tab=affiliate" role="button">Additional 7 days of free trial</a>
    @endif
</div>
<input type="hidden" id="inCurrentPlan" value="{{ MemberController::hasInsight() || MemberController::hasCompete()}}" />


<input type="hidden" id="maxMonitor" value="{{ MemberController::hasCompete() ? 20 : 5}}"/>


@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flot/jquery.flot.time.js') }}"></script>

<script src="{{ asset('assets/js/webapp/course-monitor.js?v=13') }}"></script>
<script src="{{ asset('assets/js/webapp/courseMonitorDashboard_tour.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>

<script>
    var table;
    var tableRanking;
    var backlinkTable;
    var selMCourse;
    var maxCourses = 5;
    var currCourses = 0;
    var coursesToRefresh;

    $(document).ajaxError(function(event, jqxhr, settings, exception) {
        console.log(exception);
        if (exception == 'Unauthorized' || exception == 'unknown status') {

            // Prompt user if they'd like to be redirected to the login page
            bootbox.confirm("Your session has expired. Would you like to be redirected to the login page?", function(result) {
                if (result) {
                    window.location = '/login';
                }
            });

        }
    });

    // disable datatables error prompt
    $.fn.dataTable.ext.errMode = 'none';

    function setTitleTooltips() {
        $('#coursetable th').each(function() {
            var title = $(this).text();
            var tooltip = '';
            switch (title) {
            case 'Title': tooltip = 'Course title on Udemy.'; break;
            //case 'Duration': tooltip = 'How long is the course in hours.'; break;
            //case 'Level': tooltip = 'Recommended student Level for this course.'; break;
            case 'Last Updated': tooltip = 'When was the last time the content of the course has been updated. How recent is the content?'; break;
            //case 'Created': tooltip = 'When has Teachinguide first seen this course?'; break;
            case 'Price': tooltip = 'What was the last price we have seen for this courses on Udemy without any coupon codes?'; break;
            case 'Subcategory': tooltip = 'The subcategory this course is assigned to.'; break;
            case 'Sub. Cat. Rank': tooltip = 'Subcategory rank on Udemy based on revenue. Free courses rank usually last here even if they have many enrollments (sales).'; break;
            case 'Badge': tooltip = 'Udemy badge for Courses that are Bestseller, New, Hot&New or Highest rated.'; break;
            case 'Author': tooltip = 'Course creator or instructor for that course.'; break;
            case 'Topic': tooltip = 'The dominant topic for this course.'; break;
            case 'Rating': tooltip = 'The current rating for the course.'; break;
            case 'Students': tooltip = 'Currently enrolled students in this course.'; break;
            case 'Reviews': tooltip = 'The amount of review for the courses.'; break;
            case 'Engagement': tooltip = 'Engagement is the ratio of reviews per student. A better ratio supports higher rankings.'; break;
            case 'Est. Sales': tooltip = 'The estimated amount of new enrollments for 30 days.'; break;
            case 'Promo': tooltip = 'An estimate whether there have been high discount promotions lately.'; break;
            case 'KWRP': tooltip = 'The Keyword Ranking Power (also KWRP) is a metric for keyword rankings on Udemy within the subcategory. Its based on number of ranked keywords, the rank and their traffic volume. The higher the metric, the more sales is expected.'; break;
            //case 'Mtr': tooltip = 'Add the course to your course-monitor and .'; break;
            case 'BLP': tooltip = 'Backlink Power (also BLP) is an estimate how strong the course landing page has been referred by high autorithy domains and by many backlinks.'; break;
            case 'Udy': tooltip = 'External link to udemy course detail page.'; break;
            }

            this.setAttribute( 'title', tooltip );
        });
    }

    $(document).ready(function(){
      var check = $("#inCurrentPlan").val();
      if (check == 0) {
          $(".secoverlay").show();
      }

      maxCourses = $("#maxMonitor").val();

      table = $('#coursetable').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "autoWidth": false,
          "dom": '<"html5buttons"B>',
          "buttons": [],
          "ajax": {
              "url": "{{ route('courseMonitorList') }}",
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              "dataType": "json",
              "type": "POST",
              "data": function(d) {
                  d._token = "{{ csrf_token() }}";
                },
              "complete": function() {
                  if (table.data().count() > 0)
                  {
                      $('#coursetable tbody tr:eq(0)').click();
                      currCourses = table.data().count();
                  }
              }
          },
          "order": [[11, "desc" ]],
          "columns": [
            {"data": "title"},
            {"data": "subcategory", "visible": false},
            {"data": "scrank"},
            {"data": "price", "visible": false},
            {"data": "badge", "visible": false},
            {"data": "author"},
            {"data": "topic"},
            {"data": "rating"},
            {
                "data": "students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "reviews",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "engagement", "visible" : false},
            {
                "data": "sales",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "is_promo"},
            {"data": "kwrp", "visible": false},
            {"data": "blp", "visible": false},
            {
                "data": "trend",
                "render": function (data, type, row, meta) {
                  $(".bar").peity("bar");
                  return data;
                }
            },
            {"data": "last_updated", "visible": false},
            {"data": "link"},
            {"data": "status"},
            {
              "data": "id",
              "orderable": false,
              "visible": false
            }
          ],
          "columnDefs": [
            { "orderSequence": [ "desc", "asc"], "targets": [ 7,8,9,10,11,13,14,15 ] },
          ]
      }).on('draw.dt', function() {
           renderSparklines();
      });

      $('a.toggle-vis').on( 'click', function (e) {
          e.preventDefault();

          // Get the column API object
          var column = table.column( $(this).attr('data-column') );

          // Toggle the visibility
          column.visible( ! column.visible() );
          $(this).toggleClass('lead');
          setTitleTooltips();
      });

      function renderSparklines() {
          $('.inlinesparkline').sparkline('html', {
              type: 'line',
              minSpotColor: 'red',
              maxSpotColor: 'green',
              width: '50px',
              height: '20px',
              spotColor: false
          });
      };

    setTitleTooltips();


    });

    $('.select2_course').select2({
      placeholder: "Find Course by typing or pasting a course landing page url.",
      minimumInputLength: 2,
      ajax: {
          url: '/api/courses',
          dataType: 'json',
          data: function (params) {
              var query = $.trim(params.term).replace('http://www.', '').replace('https://www.', '');
              //console.log(query);
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
        $("#addCourseBtn").removeAttr('disabled');
    });
    

    //add courses
    $("#addCourseBtn").click(function(){
    
        var course_id = $('#selCourse').val();
        $.get("/api/monitor-add-course?course_id="+course_id, function(data, status){
              table.ajax.reload(function () {
                  $(".bar").peity("bar");
                  $('#coursetable tbody tr:eq(0)').click();
                  toggleAddingCourses();
                  swal("Added!", "Course has been added.", "success");
                  $("#addCourseBtn").attr("disabled","disabled");
                  $(".select2_course").select2("val", "");
              });
        });
    });
    $("#delCourseBtn").click(function(){
      swal({
          title: "Are you sure?",
          text: "Delete '" + $(selMCourse.title).text() + "' from Monitor?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: true
          }, function () {
              var course_id = selMCourse.id;
              $.get("/api/monitor-del-course?course_id="+course_id, function(data, status){
                    table.ajax.reload(function () {
                        $(".bar").peity("bar");
                        //$('#coursetable tbody tr:eq(0)').click();
                        toggleAddingCourses();
                    });
                    $("#delCourseBtn").attr("disabled","disabled");
              });

          });

    });

    function toggleAddingCourses() {
      if (table.data().count() >= maxCourses) {
          $("#addCourseBtn").attr("disabled","disabled");
          $(".select2_course").attr("disabled","disabled");
      } else {
          
          $(".select2_course").removeAttr('disabled');
      }
    }

    $('.table-tooltips').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body",
        html: "true",
        placement: "top",
        delay: {"show": 300, "hide": 100}
    });
    var startCheck;
    $('#apifyWebhook').on('click', function() 
    {
      clearTimeout(startCheck);
      $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
      $.ajax({
        type: "POST",
        url: "{{route('postCLPJobs')}}",
        data:'courseUrl=courseUrl',  // We will use it in the future
        headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        success: function(data){
          $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
          if(data>0)
          {
            coursesToRefresh = data;
            showSuccessToast("Update for " + coursesToRefresh + " courses started. \nCourses can be updated every 5 minutes. \nPress refresh again, if an updated seems not to finish.");
            // swal({
            //     title: "Done!",
            //     text: "Crawler Succssfully Run. We'll update you soon through notification.",
            //     type: "success"
            // });
            table.ajax.reload(function () {
                $(".bar").peity("bar");
                toggleAddingCourses();
            });
            
            startCheck = setInterval(function(){
                          get_grw()
                        }, 3000);
          }
          else if(data==-1)
          {
            showSuccessToast("All monitored courses are updated. \nTry again after 5min.");
          }
          else
          {
            showErrorToast("Failed, Please try again.");
            swal({
                title: "Done!",
                text: "Failed, Please try again.",
                type: "error"
            });
          }
        }
      });
    });

    function get_grw()
    {
      $.ajax({
        type: "POST",
        url: "{{route('checkTableStatus')}}",
        data:'response=response',
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
        success: function(data){
            if(data==0)
            {
                showSuccessToast("Monitored course data has been updated.");
                // swal({
                //     title: "Done!",
                //     text: "Course monitor table succssfully refreshed.",
                //     type: "success"
                // });
                table.ajax.reload(function () {
                    $(".bar").peity("bar");
                    toggleAddingCourses();
                });
                stopChecking();
            }
            if (data < coursesToRefresh && data != 0) {
                table.ajax.reload(function () {
                    $(".bar").peity("bar");
                    toggleAddingCourses();
                });
            }
            coursesToRefresh = data;
            //var d = new Date();
            //console.log(d.toLocaleTimeString() + " - " + coursesToRefresh + " to go.");
        }
  });
}

function stopChecking() {
  clearTimeout(startCheck);
}
</script>
@endsection
