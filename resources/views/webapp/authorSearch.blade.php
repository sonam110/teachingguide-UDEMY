@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinModern.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/webapp/webapp.css?v=123') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="btn-group">
      <h2 class="webapp-header">Author Search</h2>
  </div>
  <div class="btn-group pull-right">
      <div class="pull-right webapp-header">
          <a href="/dashboard" class="btn btn-default">Dashboard</a>
      </div>
  </div>
</div>
<!--
search filter
-->
<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-1">Default Filter</a></li>
                <li class="" id><a data-toggle="tab" href="#tab-3">Columns</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <a class="collapse-link">
                                <h5>Search Filter <i class="fa fa-chevron-up"></i></h5>
                            </a>
                            <div class="ibox-tools" style="position: static;">
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-12"><h4>Filters</h4>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div id="ionrange_courses"></div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div id="ionrange_ratings"></div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div id="ionrange_students"></div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <div id="ionrange_newstudents"></div>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group" id="inputIncludeTags">
                                        <h3 class="m-t-none m-b">Include Keywords</h3>
                                        <div>
                                          <input id="includeTags" class="form-control tagsinput" type="text" placeholder="Include term"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group" id="inputExcludeTags">
                                        <h3 class="m-t-none m-b">Exclude Keywords</h3>
                                        <div>
                                          <input id="excludeTags" class="form-control tagsinput" type="text" placeholder="Exclude terms"/>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <a class="toggle-vis lead" data-column="0">Author</a> -
                            <a class="toggle-vis lead" data-column="1">Courses</a> -
                            <a class="toggle-vis lead" data-column="2">Avg Length</a> -
                            <a class="toggle-vis lead" data-column="3">Rating</a> -
                            <a class="toggle-vis lead" data-column="4">Students</a> -
                            <a class="toggle-vis lead" data-column="5">Reviews</a> -
                            <a class="toggle-vis lead" data-column="6">Engagement</a> -
                            <a class="toggle-vis lead" data-column="7">Avg Students</a> -
                            <a class="toggle-vis lead" data-column="8">Avg New Students</a> -
                            <a class="toggle-vis lead" data-column="9">Sum New Students</a> -
                            <a class="toggle-vis lead" data-column="10">Avg Reviews</a> -
                            <a class="toggle-vis lead" data-column="11">Trend</a> -
                            <a class="toggle-vis lead" data-column="12">Udemy Link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--
search results table
-->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Search Results</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive table-tooltips">
                    <table id="authortable" class="footable table table-stripped toggle-arrow-tiny">
                    <thead>
                    <tr>
                        <th data-toggle="tooltip">Author</th>
                        <th data-toggle="tooltip">Courses</th>
                        <th data-toggle="tooltip">Avg Length</th>
                        <th data-toggle="tooltip">Rating</th>
                        <th data-toggle="tooltip">Students</th>
                        <th data-toggle="tooltip">Reviews</th>
                        <th data-toggle="tooltip">Engagement</th>
                        <th data-toggle="tooltip">Avg Students</th>
                        <th data-toggle="tooltip">Avg New Students</th>
                        <th data-toggle="tooltip">Sum New Students</th>
                        <th data-toggle="tooltip">Avg Reviews</th>
                        <th data-toggle="tooltip">Trend</th>
                        <th data-toggle="tooltip">Udemy</th>
                    </tr>
                    </thead>
                    <tbody id="author-info">

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
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
<?php use App\Http\Controllers\MemberController;?>
<input type="hidden" id="inCurrentPlan" value="{{ MemberController::hasInsight() || MemberController::hasCompete()}}" />

@endsection


@section('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/webapp/authorSearch_tour.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>

<script>
    var table;
    var newStudentsFrom, newStudentsTo;
    var coursesFrom, coursesTo;
    var studentsFrom, studentsTo;
    var ratingsFrom, ratingsTo;

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

    $(document).ready(function(){

      var check = $("#inCurrentPlan").val();
      if (check == 0) {
          $(".secoverlay").show();
      }

      table = $('#authortable').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "autoWidth": false,
          "language": {
            "decimal": ",",
            "thousands": "."
          },
          "dom": '<"html5buttons"B>itlp',
          "buttons": [
                   {extend: 'copy'},
                   {extend: 'csv'},
                   {extend: 'excel', title: 'ExampleFile'}
               ],
          "ajax": {
              "url": "{{ route('authorData') }}",
              "dataType": "json",
              "type": "POST",
              //"data": {"_token": "{{ csrf_token() }}"}
              "data": function(d) {
                  d._token = "{{ csrf_token() }}";
                  d.IncTags = $('#includeTags').val();
                  d.ExcTags = $('#excludeTags').val();
                  d.minCourses = coursesFrom;
                  d.maxCourses = coursesTo;
                  d.minRating = ratingsFrom;
                  d.maxRating = ratingsTo;
                  d.minStudents = studentsFrom;
                  d.maxStudents = studentsTo;
                  d.minNewStudents = newStudentsFrom;
                  d.maxNewStudents = newStudentsTo;
              }
          },
          "order": [[9, "desc" ]],
          "columns": [
            {"data": "author"},
            {"data": "courses"},
            {"data": "avg_duration"},
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
            {"data": "engagement"},
            {
                "data": "avg_students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "avg_new_students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "sum_new_students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "avg_reviews",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "atrend"},
            {"data": "link"},
          ],
          "columnDefs": [{
              "targets": [12], // column or columns numbers
              "orderable": false,  // set orderable for selected columns
          },
          {
              "targets": [ 2 ],
              "visible": false
          }],
          "columnDefs": [
            { "orderSequence": [ "desc", "asc"], "targets": [ 1,2,3,4,5,6,7,8,9,10,11 ] },
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

      $('#authortable th').each(function() {
        var title = $(this).text();
        var tooltip = '';
        switch (title) {
          case 'Author': tooltip = 'Course creator or instructor name.'; break;
          case 'Courses': tooltip = 'Amount of course publish on Udemy.'; break;
          case 'Avg Lenght': tooltip = 'Average Course Length in Hours.'; break;
          case 'Courses TG': tooltip = 'Amount of course loaded into teachinGuide.'; break;
          case 'Rating': tooltip = 'Average rating over all published courses.'; break;
          case 'Students': tooltip = 'Currently enrolled students in all courses.'; break;
          case 'Reviews': tooltip = 'Overall reviews for all courses.'; break;
          case 'Avg Students': tooltip = 'The average amount of enrolled students per course for that author. Might be an indicator for specialization or time of the platform.'; break;
          case 'Avg New Students': tooltip = 'The average amount of new enrolled students per course within the last 30 days.'; break;
          case 'Sum New Students': tooltip = 'The sum of all enrollments within the last 30 days for this author.'; break;
          case 'Avg Reviews': tooltip = 'The average amount of reviews per course for author.'; break;
          case 'Avg Rating': tooltip = 'The average rating for courses in the topic.'; break;
          case 'Engagement': tooltip = 'Engagement is the ratio of reviews per student. A better ratio supports higher rankings.'; break;
          case 'Trend': tooltip = 'The trend for this authors enrollments over the last 10 weeks for his/her courses.'; break;
          case 'Udemy': tooltip = 'External link to udemy course detail page.'; break;
        }

        this.setAttribute( 'title', tooltip );
      });

      $('.tagsinput').tagsinput({
          tagClass: 'label label-primary'
      });

      $('#read-data').on('click', function(){
          table.ajax.reload();
      });


      $('#includeTags, #excludeTags').on('change', function(e){
          table.ajax.reload();
      });

    });

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 13) {
        table.ajax.reload();
        return false;
      }

      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    $("#ionrange_students").ionRangeSlider({
        min: 1,
        max: 100000,
        step: 1000,
        type: 'double',
        prefix: "Students: ",
        maxPostfix: "+",
        prettify: true,
        hasGrid: false,
        force_edges: true,
        onFinish: function (data) {
            if (data.max == data.to) {
                studentsTo = null;
            } else {
                studentsTo = data.to;
            }
            studentsFrom = data.from;
            table.ajax.reload();
        }
    });
    $("#ionrange_courses").ionRangeSlider({
        min: 0,
        max: 100,
        step: 1,
        type: 'double',
        prefix: "Courses: ",
        maxPostfix: "+",
        prettify: true,
        hasGrid: false,
        force_edges: true,
        onFinish: function (data) {
            if (data.max == data.to) {
                coursesTo = null;
            } else {
                coursesTo = data.to;
            }
            coursesFrom = data.from;
            table.ajax.reload();
        }
    });
    $("#ionrange_newstudents").ionRangeSlider({
        min: 0,
        max: 5000,
        step: 50,
        type: 'double',
        prefix: "New Students: ",
        maxPostfix: "+",
        prettify: true,
        hasGrid: false,
        force_edges: true,
        onFinish: function (data) {
            if (data.max == data.to) {
                newStudentsTo = null;
            } else {
                newStudentsTo = data.to;
            }
            newStudentsFrom = data.from;
            table.ajax.reload();
        }
    });
    $("#ionrange_ratings").ionRangeSlider({
        min: 0,
        max: 5,
        step: 0.1,
        type: 'double',
        prefix: "Ratings: ",
        maxPostfix: "+",
        prettify: true,
        hasGrid: false,
        force_edges: true,
        onFinish: function (data) {
            if (data.max == data.to) {
                ratingsTo = null;
            } else {
                ratingsTo = data.to;
            }
            ratingsFrom = data.from;
            table.ajax.reload();
        }
    });

    $('.table-tooltips').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body",
        html: "true",
        placement: "top",
        delay: {"show": 300, "hide": 100}
    });


</script>
@endsection
