@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinModern.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/webapp/webapp.css?v=123') }}" rel="stylesheet">

@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="btn-group">
      <h2 class="webapp-header">Subcategories</h2>
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
              <li class="{{ $filter == 0 ? 'active' : ''}}"><a data-toggle="tab" href="#tab-1">Default Filter</a></li>
              <li class="" id><a data-toggle="tab" href="#tab-3">Columns</a></li>
          </ul>
          <div class="tab-content">
            <div id="tab-1" class="tab-pane {{ $filter == 0 ? 'active' : ''}}">
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
                            <div class="col-md-4 b-r"><h3 class="m-t-none m-b">Categories</h3>
                              <div class="col-md-6">
                                  <div class="i-checks"><label> <input id="chkCatAll" type="checkbox"> <i></i> All Categories</label></div>
                                  <div class="i-checks"><label> <input id="chkCatDev" type="checkbox"> <i></i> Development</label></div>
                                  <div class="i-checks"><label> <input id="chkCatBus" type="checkbox" value=""> <i></i> Business</label></div>
                                  <div class="i-checks"><label> <input id="chkCatITS" type="checkbox" value=""> <i></i> IT & Software</label></div>
                                  <div class="i-checks"><label> <input id="chkCatOff" type="checkbox" value=""> <i></i> Office Productivity</label></div>
                                  <div class="i-checks"><label> <input id="chkCatPer" type="checkbox" value=""> <i></i> Personal Development</label></div>
                                  <div class="i-checks"><label> <input id="chkCatDes" type="checkbox" value=""> <i></i> Design</label></div>
                                  <div class="i-checks"><label> <input id="chkCatMar" type="checkbox" value=""> <i></i> Marketing</label></div>
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
                            </div>
                            <div class="col-md-8">
                                <h4>Filters</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <div id="ionrange_freeratio"></div>
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
                                    <div class="form-group" id="inputIncludeTags">
                                        <h3 class="m-t-none m-b">Include Keywords</h3>
                                        <div class="col-md-10" style="padding: 0px;">
                                            <input id="includeTags" class="form-control tagsinput" type="text" placeholder="Include term"/>
                                        </div>
                                        <div class="col-md-2">
                                          <input id="IncKeyRel" type="checkbox" checked data-toggle="toggle" data-on="or" data-off="and" data-onstyle="primary" data-offstyle="warning">
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
                        <a class="toggle-vis lead" data-column="0">Subcategory</a> -
                        <a class="toggle-vis lead" data-column="1">Category</a> -
                        <a class="toggle-vis lead" data-column="2">Instructors</a> -
                        <a class="toggle-vis lead" data-column="3">Topics</a> -
                        <a class="toggle-vis lead" data-column="4">Courses</a> -
                        <a class="toggle-vis " data-column="5">Avg Length</a> -
                        <a class="toggle-vis " data-column="6">Avg Price</a> -
                        <a class="toggle-vis " data-column="7">Avg Rating</a> -
                        <a class="toggle-vis " data-column="8">Avg Engagement</a> -
                        <a class="toggle-vis lead" data-column="9">Students</a> -
                        <a class="toggle-vis lead" data-column="10">Reviews</a> -
                        <a class="toggle-vis lead" data-column="11">Engagement</a> -
                        <a class="toggle-vis lead" data-column="12">Top Students</a> -
                        <a class="toggle-vis lead" data-column="13">Top Reviews</a> -
                        <a class="toggle-vis lead" data-column="14">Est. Sales</a> -
                        <a class="toggle-vis lead" data-column="15">Trend</a>
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
                    <table id="subcattable" class="footable table table-stripped toggle-arrow-tiny">
                    <thead>
                    <tr>
                        <th data-toggle="tooltip">SubCategory</th>
                        <th data-toggle="tooltip">Category</th>
                        <th data-toggle="tooltip">Instructors</th>
                        <th data-toggle="tooltip">Topics</th>
                        <th data-toggle="tooltip">Courses</th>
                        <th data-toggle="tooltip">Avg Length</th>
                        <th data-toggle="tooltip">Avg Price</th>
                        <th data-toggle="tooltip">Avg Rating</th>
                        <th data-toggle="tooltip">Avg Engagement</th>
                        <th data-toggle="tooltip">Students</th>
                        <th data-toggle="tooltip">Reviews</th>
                        <th data-toggle="tooltip">Engagement</th>
                        <th data-toggle="tooltip">Top Students</th>
                        <th data-toggle="tooltip">Top Reviews</th>
                        <th data-toggle="tooltip">Est. Sales</th>
                        <th data-toggle="tooltip">Trend</th>
                    </tr>
                    </thead>
                    <tbody id="subcat-info">

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

<input type="hidden" id="filter_id" value="{{ $filter }}" />
@endsection


@section('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/webapp/topicSearch_tour.js?v=123') }}"></script>

<script>
    var table;
    var freeFrom, freeTo;
    var coursesFrom, coursesTo;
    var studentsFrom, studentsTo;
    var ratingsFrom, ratingsTo;
    var useCustomFilter;
    var customFilterID;
    var tooltip;


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
      customFilterID = $('#filter_id').val();
      if (customFilterID == 0) {
          useCustomFilter = 0;
      } else {
          useCustomFilter = 1;
          console.log("activate customTab");
          $('.tab-pane a[href="#tab-2"]').tab('show');
          //$("#myTab li:eq(2) a").tab('show');
      }

      var check = $("#inCurrentPlan").val();
      if (check == 0) {
          $(".secoverlay").show();
      }

      table = $('#subcattable').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "autoWidth": false,
          "dom": '<"html5buttons"B>itlp',
          "buttons": [
                   {extend: 'copy'},
                   {extend: 'csv'},
                   {extend: 'excel', title: 'ExampleFile'}
               ],
          "ajax": {
              "url": "{{ route('subcatData') }}",
              "dataType": "json",
              "type": "POST",
              //"data": {"_token": "{{ csrf_token() }}"}
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
                  d.IncTags = $('#includeTags').val();
                  d.IncKeyRel = $('#IncKeyRel').prop('checked');
                  d.ExcTags = $('#excludeTags').val();
                  d.minEnrollments = studentsFrom;
                  d.maxEnrollments = studentsTo;
                  d.minCourses = coursesFrom;
                  d.maxCourses = coursesTo;
                  d.minAvgRating = ratingsFrom;
                  d.maxAvgRating =ratingsTo;
                  d.useCustomFilter = useCustomFilter;
                  d.customFilterID = customFilterID;
              }
          },
          "order": [[14, "desc" ]],
          "columns": [
            {"data": "subcategory"},
            {"data": "category"},
            {"data": "instructors"},
            {"data": "topics"},
            {"data": "courses"},
            {"data": "avg_length", "visible": false},
            {"data": "avg_price", "visible": false},
            {"data": "avg_rating", "visible": false},
            {"data": "avg_engagement", "visible": false},
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
                "data": "top_students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "top_reviews",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "sales30",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "trend"},
          ],
          "columnDefs": [
            { "orderSequence": [ "desc", "asc"], "targets": [ 2,3,4,5,6,7,8,9,10,11,12,13,14,15 ] },
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
          setToolTips();
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

      function setToolTips() {
          $('#subcattable th').each(function() {
                var title = $(this).text();
                switch (title) {
                case 'SubCategory': tooltip = 'The subcategory name.'; break;
                case 'Category': tooltip = 'The category this subcategory is assigned to.'; break;
                case 'Instructors': tooltip = 'Amount course instructors offering courses within that subcategory.'; break;
                case 'Topics': tooltip = 'Amount of topics within that subcategory.'; break;
                case 'Courses': tooltip = 'Amount of courses assigned and listed to that subcategory on Udemy.'; break;
                case 'Students': tooltip = 'The overall sum of enrolled students in all courses assigned to this subcategory.'; break;
                case 'Reviews': tooltip = 'The overall sum of reviews for all courses in this subcategory.'; break;
                case 'Engagement': tooltip = 'Engagement is the ratio of reviews per student. A better ratio supports higher rankings.'; break;
                case 'Top Students': tooltip = 'How many students has the number 1 course in this subcategory enrolled. Can you compete?'; break;
                case 'Top Reviews': tooltip = 'How many reviews has the number 1 course in this subcategory earned. Can you compete?'; break;
                case 'Est. Sales': tooltip = 'The estimated amount of new enrollments for 30 days.'; break;
                case 'Trend': tooltip = 'The trend for this subcategory over the last 10 weeks on Udemy in terms of enrollments of its assigned courses.'; break;
                case 'Avg Length': tooltip = 'The average length of courses in this subcategory.'; break;
                case 'Avg Price': tooltip = 'The average price in USD for courses in the Subcategory.'; break;
                case 'Avg Rating': tooltip = 'The average rating for courses in the Subcategory.'; break;
                case 'Avg Engagement': tooltip = 'The average engagement (reviews/students) for courses in the Subcategory.'; break;
                }

                this.setAttribute( 'title', tooltip );
            });
      }

      setToolTips();

      $('.tagsinput').tagsinput({
          tagClass: 'label label-primary'
      });

      $('#read-data').on('click', function(){
          table.ajax.reload();
      });

      $('#read-data #defaultTab').on('click', function(){
          console.log("tab click");
          useCustomFilter = 0;
          table.ajax.reload();
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
        if (target=='#tab-1') {
            console.log("tab click");
            useCustomFilter = 0;
            table.ajax.reload();
        }
      });

      $('#includeTags, #excludeTags, #IncKeyRel, .i-checks').on('change', function(e){
          table.ajax.reload();
      });

      $.get("/api/filter-list-topic", function(data, status){
            //var obj = JSON.parse(data);
            $.each(data, function(i,item) {
                $('#selFilter').append( '<option value="'+ item.id+ '">'+ item.name+ '</option>' );
            });
            if (data.length > 0) {
                console.log("remove disabled");
                $("#filterApply").removeAttr("disabled");
                $("#filterEdit").removeAttr("disabled");
                $("#filterDelete").removeAttr("disabled");
            }
            var filter_id = $('#filter_id').val();
            if (filter_id != 0) {
                $('#selFilter').val(filter_id);
            }
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

    $('.chosen-select').chosen({width: "100%"});

    $("#ionrange_freeratio").ionRangeSlider({
        min: 1,
        max: 100,
        step: 1,
        type: 'double',
        prefix: "FreeR: ",
        maxPostfix: "+",
        prettify: true,
        hasGrid: false,
        force_edges: true,
        onFinish: function (data) {
            if (data.max == data.to) {
                freeTo = null;
            } else {
                freeTo = data.to;
            }
            freeFrom = data.from;
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
                studentsTo = null;
            } else {
                studentsTo = data.to;
            }
            studentsFrom = data.from;
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

    $('#filterEdit').on('click', function(){
        var id = $('#selFilter').val();
        var url = "/filter/"+id+"/edit";
        console.log(url);
        window.location.href = url;
    });

    $('#filterApply').on('click', function() {
        customFilterID = $('#selFilter').val();
        useCustomFilter = 1;
        table.ajax.reload();
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
