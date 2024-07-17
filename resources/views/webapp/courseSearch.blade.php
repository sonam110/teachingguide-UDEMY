@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
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
<div class="row wrapper border-bottom white-bg page-heading" id="tStart">
  <div class="btn-group">
      <h2 class="webapp-header">Course Database</h2>
  </div>
  <div class="btn-group pull-right">
      <div class="pull-right webapp-header">
          <a href="#" class="btn btn-info tutorial"><i class="fa fa-play"></i> Tutorial</a>
          <!-- <a href="#" class="btn btn-info startTour"><i class="fa fa-play"></i> Start Tour</a> -->
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
                <li class="{{ $filter > 0 ? 'active' : ''}}" id><a data-toggle="tab" href="#tab-2">Custom Filter</a></li>
                <li class="" id><a data-toggle="tab" href="#tab-3">Columns</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane {{ $filter == 0 ? 'active' : ''}}">
                    <div class="ibox float-e-margins">
                      <a class="collapse-link">

                        <div class="ibox-title">
                                <h5 id="tFilter">Search Filter <i class="fa fa-chevron-up"></i></h5>
                        </div>
                      </a>
                      <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-4 b-r" id="tCategories">
                                  <h3 class="m-t-none m-b">Categories</h3>
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
                                        </br></br>
                                        <input id="FreeCourses" type="checkbox" checked data-toggle="toggle" data-on="Including Free Courses" data-off="Excluding Free Courses" data-onstyle="primary" data-offstyle="warning">
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
                                </div>
                                <div class="col-md-8" id="tDetailFilter">
                                  <h4>Filters</h4>
                                  <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group" id="data_1">
                                          <select id="selPrices" data-placeholder="All Prices" class="select2_prices form-control m-b" style="width:100%!important;">
                                            <option value="All">All Price Categories</option>
                                            <option value="Free">Free Courses</option>
                                            <option value="Paid">Paid Courses</option>
                                          </select>
                                        </div>
                                        <div class="form-group" id="selectAuthor">
                                          <div>
                                            <select id="selAuthor" data-placeholder="All Author" class="select2_authors form-control" multiple="multiple"  style="width:100%!important;"></select>
                                          </div>
                                        </div>
                                        <div class="form-group" id="selectBadge">
                                          <div>
                                            <select id="selBadge" data-placeholder="All Badges" class="select2_badge form-control m-b" multiple="multiple" style="width:100%!important;">
                                              <option value="New">New</option>
                                              <option value="Hot & New">Hot & New</option>
                                              <option value="Highest Rated">Highest Rated</option>
                                              <option value="Best Seller">Best Seller</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group" id="selectSubCat">
                                          <div>
                                            <select id="selSubCat" data-placeholder="All Subcategories" class="select2_subcat form-control m-b" multiple="multiple" style="width:100%!important;"></select>
                                          </div>
                                        </div>
                                        <!-- <div class="form-group" id="selectLevel">
                                          <div>
                                            <select id="selLevel" data-placeholder="All Levels" class="select2_level form-control m-b" multiple="multiple" style="width:100%!important;">
                                              <option value="All">No specific</option>
                                              <option value="Beginner">Beginner</option>
                                              <option value="Intermediate">Intermediate</option>
                                              <option value="Expert">Expert</option>
                                            </select>
                                          </div>
                                        </div> -->
                                        <div class="form-group" id="selectTopic">
                                          <div>
                                            <select id="selTopic" data-placeholder="All Topics" class="select2_topic form-control m-b" multiple="multiple" style="width:100%!important;"></select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <div id="ionrange_rank"></div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <div id="ionrange_sales"></div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <div id="ionrange_reviews"></div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <div id="ionrange_students"></div>
                                            </div>
                                          </div>
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
                                            <div class="col-md-2" id="tIncKeyRel">
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
                <div id="tab-2" class="tab-pane {{ $filter > 0 ? 'active' : ''}}">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                              <select id="selFilter" data-placeholder="Select Filter" class="select2_filter form-control m-b">
                              </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <button id="filterApply" class="btn btn-success" type="button" href="#" disabled><i class="fa fa-calculator"></i> Results</button>
                            <button id="filterEdit" class="btn btn-info" type="button" href="#" disabled><i class="fa fa-sliders"></i> Edit</button>
                            <a href="/filter/create"><button id="filterCreate" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> <span class="bold">Create New</span></button></a>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <a class="toggle-vis lead" data-column="0">Title</a> -
                            <a class="toggle-vis" data-column="1">Duration</a> -
                            <a class="toggle-vis" data-column="2">Level</a> -
                            <a class="toggle-vis" data-column="3">Last Updated</a> -
                            <a class="toggle-vis" data-column="4">Created</a> -
                            <a class="toggle-vis" data-column="5">Price</a> -
                            <a class="toggle-vis lead" data-column="6">Subcategory</a> -
                            <a class="toggle-vis lead" data-column="7">Sub. Cat. Rank</a> -
                            <a class="toggle-vis lead" data-column="8">Badge</a> -
                            <a class="toggle-vis lead" data-column="9">Author</a> -
                            <a class="toggle-vis lead" data-column="10">Topic</a> -
                            <a class="toggle-vis lead" data-column="11">Rating</a> -
                            <a class="toggle-vis lead" data-column="12">Students</a> -
                            <a class="toggle-vis lead" data-column="13">Reviews</a> -
                            <a class="toggle-vis" data-column="14">Engagement</a> -
                            <a class="toggle-vis lead" data-column="15">Est. Sales</a> -
                            <a class="toggle-vis" data-column="16">Trend</a> -
                            <a class="toggle-vis" data-column="17">Promo</a> -
                            <a class="toggle-vis" data-column="18">KWRP</a> -
                            <a class="toggle-vis" data-column="19">BLP</a> -
                            <a class="toggle-vis lead" data-column="20">Monitor</a> -
                            <a class="toggle-vis lead" data-column="21">Udemy Link</a>
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
        <div class="ibox float-e-margins" id="tCourseTable">
            <div class="ibox-title">
                <h5>Search Results</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul id="colconfigs" class="dropdown-menu dropdown-user">
                        <li><a class="colconfig fa fa-check" config-col="1"href="#">&nbsp;Default View</a></li>
                        <li><a class="colconfig" config-col="2" href="#">&nbsp;Performance View</a></li>
                        <li><a class="colconfig" config-col="3" href="#">&nbsp;Student View</a></li>
                        <li class="divider"></li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive table-tooltips">
                    <table id="coursetable" class="table table-stripped display responsive">
                    <thead>
                    <tr>
                        <th data-toggle="tooltip">Title</th>
                        <th data-toggle="tooltip">Duration</th>
                        <th data-toggle="tooltip">Level</th>
                        <th data-toggle="tooltip">Last Updated</th>
                        <th data-toggle="tooltip">Created</th>
                        <th data-toggle="tooltip">Price</th>
                        <th data-toggle="tooltip">Subcategory</th>
                        <th data-toggle="tooltip">Sub. Cat. Rank</th>
                        <th data-toggle="tooltip">Badge</th>
                        <th data-toggle="tooltip">Author</th>
                        <th data-toggle="tooltip">Topic</th>
                        <th data-toggle="tooltip">Rating</th>
                        <th data-toggle="tooltip">Students</th>
                        <th data-toggle="tooltip">Reviews</th>
                        <th data-toggle="tooltip">Engagement</th>
                        <th data-toggle="tooltip">Est. Sales</th>
                        <th data-toggle="tooltip">Trend</th>
                        <th data-toggle="tooltip">Promo</th>
                        <th data-toggle="tooltip">KWRP</th>
                        <th data-toggle="tooltip">BLP</th>
                        <th data-toggle="tooltip">Mtr</th>
                        <th data-toggle="tooltip">Udy</th>
                    </tr>
                    </thead>
                    <tbody id="course-info">

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
<input type="hidden" id="inCurrentPlan" value="{{ MemberController::hasStudent()}}" />


<!-- params -->
@if (isset($author))
<input type="hidden" id="author_id" value="{{ $author->author_id }}" />
<input type="hidden" id="author" value="{{ $author->author }}" />
@endif
@if (isset($topic))
<input type="hidden" id="topic_id" value="{{ $topic->topic_id }}" />
<input type="hidden" id="topic" value="{{ $topic->topic }}" />
@endif
@if (isset($subcat))
<input type="hidden" id="subcat_id" value="{{ $subcat->subcategory_id }}" />
<input type="hidden" id="subcat" value="{{ $subcat->subcategory }}" />
@endif

<input type="text" id="filter_id" value="{{ $filter }}" />
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
<script src="{{ asset('assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/webapp/courseSearch_tour.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>

<script>
    var table;
    var rankFrom, rankTo;
    var salesFrom, salesTo;
    var reviewsFrom, reviewsTo;
    var studentsFrom, studentsTo;
    var useCustomFilter;
    var customFilterID;
    var monitorCol;

    function tryAddRemoCourseMOnitor(that) {
        var course = table.row($(that).parents('tr')).data()
        var course_id = course.course_id;
        var action = course.monitor;
        var title = course.title;
        if (action == 0) {
            $.get("/api/monitor-add-course?course_id="+course_id, function(data, status){
            }).done(function(data){
                if (data == -1) {
                    showErrorToast("Sorry. No slots available on your Course-Monitor. Delete some or upgrade your subscription.", 6000);
                }
                if (data == 0) {
                    showErrorToast("'" + course.title + "' is already on your Course-Monitor.", 6000);
                }
                if (data == 1) {
                    showSuccessToast("'" + course.title + "' has been added to your Course-Monitor", 6000);
                    table.ajax.reload();
                }
            });
        }
        if (action == 1) {
            $.get("/api/monitor-del-course?course_id="+course_id, function(data, status){
            }).done(function(data){
                if (data == 0) {
                    showErrorToast("'" + course.title + "' could not be removed from your Course-Monitor.", 6000);
                }
                if (data == 1) {
                    showSuccessToast("'" + course.title + "' has been removed from your Course-Monitor", 6000);
                    table.ajax.reload();
                }
              });
        }
    }

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
            case 'Duration': tooltip = 'How long is the course in hours.'; break;
            case 'Level': tooltip = 'Recommended student Level for this course.'; break;
            case 'Last Updated': tooltip = 'When was the last time the content of the course has been updated. How recent is the content?'; break;
            case 'Created': tooltip = 'When has Teachinguide first seen this course?'; break;
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
            case 'BLP': tooltip = 'Backlink Power (also BLP) is an estimate how strong the course landing page has been referred by high autorithy domains and by many backlinks.'; break;
            case 'Mtr': tooltip = 'Add the course to your course-monitor and .'; break;
            case 'Udy': tooltip = 'External link to udemy course detail page.'; break;
            }

            this.setAttribute( 'title', tooltip );
        });
    }

    $(document).ready(function(){
      monitorCol = 11;
      customFilterID = $('#filter_id').val();
      if (customFilterID == 0) {
          useCustomFilter = 0;
      } else {
          useCustomFilter = 1;
          $('.tab-pane a[href="#tab-2"]').tab('show');
          //$("#myTab li:eq(2) a").tab('show');
      }

      var check = $("#inCurrentPlan").val();
      if (check == 0) {
          $(".secoverlay").show();
      }


      $('#data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
      });

      table = $('#coursetable').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "autoWidth": false,
          "dom": '<"html5buttons"B>itlp',
          "buttons": [
                   {extend: 'copy'},
                   {extend: 'csv'},
                   {extend: 'excel', title: 'tg_course_data'}
               ],
          "ajax": {
              "url": "{{ route('courseData') }}",
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
                  d.FreeCourses = $('#FreeCourses').prop('checked');
                  d.IncTags = $('#includeTags').val();
                  d.IncKeyRel = $('#IncKeyRel').prop('checked');
                  d.ExcTags = $('#excludeTags').val();
                  d.Authors = $('#selAuthor').val();
                  d.Level = $('#selLevel').val();
                  d.Badge = $('#selBadge').val();
                  d.Topic = $('#selTopic').val();
                  d.SubCat = $('#selSubCat').val();
                  d.Prices = $('#selPrices').val();
                  d.minRank = rankFrom;
                  d.minSales = salesFrom;
                  d.minReviews = reviewsFrom;
                  d.minRating = $('#minRating').val();
                  d.minStudents = studentsFrom;
                  d.maxRank = rankTo;
                  d.maxSales = salesTo;
                  d.maxReviews = reviewsTo;
                  d.maxRating = $('#maxRating').val();
                  d.maxStudents = studentsTo;
                  d.useCustomFilter = useCustomFilter;
                  d.customFilterID = customFilterID;
              }
          },
          "order": [[15, "desc" ]],
          "columns": [
            {"data": "title"},
            {"data": "duration", "visible": false},
            {"data": "level", "visible": false},
            {
              "data": "last_updated.date",
              "visible": false,
              "render": function (data, type, row, meta) {
                 if(type === 'display'){
                    var dat = new Date(Date.parse(data));
                    return dat.toLocaleDateString('en-US');
                 } else {
                    return data;
                 }
              }
            },
            {
              "data": "created",
              "visible": false,
              "render": function (data, type, row, meta) {
                 if(type === 'display'){
                    var dat = new Date(Date.parse(data));
                    return dat.toLocaleDateString('en-US');
                 } else {
                    return data;
                 }
              }
            },
            {"data": "price", "visible": false},
            {"data": "subcategory"},
            {"data": "rank"},
            {"data": "badge"},
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
            {"data": "engagement", "visible": false},
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
            {
                "data": "ctrend",
                "visible": false
            },
            {"data": "is_promo", "visible": false},
            {"data": "kwrp", "visible": false},
            {"data": "blp", "visible": false},
            {
                "data": "monitor",
                "orderable": false,
                "render": function (data, type, row, meta) {
                   if(data === 1){
                      return "<a class='text-danger' href'#'> <i class='fa fa-minus'/> </a>";
                   } else {
                      return "<a class='text-navy' href'#'> <i class='fa fa-plus'/> </a>";
                   }
                }
              },
            {
              "data": "link",
              "orderable": false
            },
            {
              "data": "course_id",
              "orderable": false,
              "visible": false
            },
          ],
          "columnDefs": [
            { "orderSequence": [ "desc", "asc"], "targets": [ 1,3,11,12,13,14,15,16 ] },
          ]
      }).on('draw.dt', function() {
           renderSparklines();
      });

      function renderSparklines() {
          $('.inlinesparkline').sparkline('html', {
              type: 'line',
              minSpotColor: 'red',
              maxSpotColor: 'green',
              disableHiddenCheck: true,
              width: '50px',
              height: '20px',
              spotColor: false
          }).removeClass('inlinesparkline');
      };

      $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        //update monitor column monitorCol
        $('#coursetable tbody').off('click', 'td:nth-child('+monitorCol+')');
        if (column.visible()) {
          monitorCol = monitorCol - 1;
        } else {
          monitorCol = monitorCol + 1;
        }
        $('#coursetable tbody').on( 'click', 'td:nth-child('+monitorCol+')', function () {
            tryAddRemoCourseMOnitor(this);
        });
        // Toggle the visibility
        column.visible( ! column.visible() );
        $(this).toggleClass('lead');
        //renderSparklines();
        table.ajax.reload();
        setTitleTooltips();

      } );



      $('#coursetable tbody').on( 'click', 'td:nth-child('+monitorCol+')', function () {
          tryAddRemoCourseMOnitor(this);
      });

      setTitleTooltips();

      $('.tagsinput').tagsinput({
          tagClass: 'label label-primary'
      });
      
      $('.tutorial').on('click', function(){
          window.open('https://www.youtube.com/watch?v=C6cqwmXkF7Q', '_blank');
      });
      

      $('#read-data #defaultTab').on('click', function(){
          useCustomFilter = 0;
          table.ajax.reload();
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
        if (target=='#tab-1') {
            useCustomFilter = 0;
            table.ajax.reload();
        }
      });

      $('#selAuthor, #selTopic, #selSubCat, #selPrices, #selLevel, #selBadge, #includeTags, #excludeTags, #IncKeyRel, #FreeCourses, .i-checks').on('change', function(e) {
          useCustomFilter = 0;
          table.ajax.reload();
      });

      $.get("/api/filter-list-course", function(data, status){
            //var obj = JSON.parse(data);
            $.each(data, function(i,item) {
                $('#selFilter').append( '<option value="'+ item.id+ '">'+ item.name+ '</option>' );
            });
            if (data.length > 0) {
                $("#filterApply").removeAttr("disabled");
                $("#filterEdit").removeAttr("disabled");
                $("#filterDelete").removeAttr("disabled");
            }
            var filter_id = $('#filter_id').val();
            if (filter_id != 0) {
                $('#selFilter').val(filter_id);
            }
      });

      //get user defined column configs
      $.get("/api/settings-list?r=2&o=1", function(data, status){
            //var obj = JSON.parse(data);
            $.each(data, function(i,item) {
                $('#colconfigs').append( '<li><a class="colconfig" config-col="'+item.id+'" href="#">&nbsp;'+item.name+'</a></li>');
            });

            $('a.colconfig').on( 'click', function (e) {
                clickColConfig(this, e);
            });
      });

    });

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

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 13) {
        useCustomFilter = 0;
        table.ajax.reload();
        return false;
      }

      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    $('.chosen-select').chosen({width: "100%"});
    $('.select2_badge, .select2_level, .select2_prices').select2();
    $('.select2_authors').select2({
          placeholder: "All Authors",
          minimumInputLength: 2,
          ajax: {
              url: '/api/authors',
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
                url: '/api/topics',
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
                  url: '/api/subcats',
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

        $('#FreeCourses').bootstrapToggle({
            width: '200px'
        });
        $("#ionrange_rank").ionRangeSlider({
            min: 1,
            max: 1000,
            step: 10,
            type: 'double',
            prefix: "Rank: ",
            maxPostfix: "+",
            prettify: true,
            hasGrid: false,
            force_edges: true,
            onFinish: function (data) {
                if (data.max == data.to) {
                    rankTo = null;
                } else {
                    rankTo = data.to;
                }
                rankFrom = data.from;
                useCustomFilter = 0;
                table.ajax.reload();
            }
        });
        $("#ionrange_sales").ionRangeSlider({
            min: 0,
            max: 1000,
            step: 10,
            type: 'double',
            prefix: "Sales: ",
            maxPostfix: "+",
            prettify: true,
            hasGrid: false,
            force_edges: true,
            onFinish: function (data) {
                if (data.max == data.to) {
                    salesTo = null;
                } else {
                    salesTo = data.to;
                }
                salesFrom = data.from;
                alert(salesTo);
                alert(salesFrom);
                useCustomFilter = 0;
                table.ajax.reload();
            }
        });
        $("#ionrange_reviews").ionRangeSlider({
            min: 0,
            max: 5000,
            step: 50,
            type: 'double',
            prefix: "Reviews: ",
            maxPostfix: "+",
            prettify: true,
            hasGrid: false,
            force_edges: true,
            onFinish: function (data) {
                if (data.max == data.to) {
                    reviewsTo = null;
                } else {
                    reviewsTo = data.to;
                }
                reviewsFrom = data.from;
                useCustomFilter = 0;
                table.ajax.reload();
            }
        });
        $("#ionrange_students").ionRangeSlider({
            min: 0,
            max: 10000,
            step: 100,
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
                useCustomFilter = 0;
                table.ajax.reload();
            }
        });

    $('#filterEdit').on('click', function(){
        var id = $('#selFilter').val();
        var url = "/filter/"+id+"/edit";
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

    function clickColConfig(that, e) {
        e.preventDefault();

        // Get the column API object
        var cfg = $(that).attr('config-col');
        var options1 = [1,0,0,0,0,0,1,1,1,1,1,1,1,1,0,1,0,0,0,0,1,1];
        var options2 = [1,0,0,0,0,0,0,1,0,1,1,1,1,1,1,1,1,1,0,0,1,0];
        var options3 = [1,1,1,1,0,1,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,1];

        switch (cfg) {
            case "1":
              toggleColConfig(options1, 1);
              $('#coursetable tbody').off('click', 'td:nth-child('+monitorCol+')');
              monitorCol = 11;
              $('#coursetable tbody').on( 'click', 'td:nth-child('+monitorCol+')', function () {
                  tryAddRemoCourseMOnitor(this);
              });
              break;
            case "2":
              toggleColConfig(options2, 2);
              $('#coursetable tbody').off('click', 'td:nth-child('+monitorCol+')');
              monitorCol = 12;
              $('#coursetable tbody').on( 'click', 'td:nth-child('+monitorCol+')', function () {
                  tryAddRemoCourseMOnitor(this);
              });
              break;
            case "3":
              toggleColConfig(options3, 3);
              break;
            default:
              getCustomColConfig(cfg); break;
        }
    }

    function getCustomColConfig(id) {
      $.get("/api/settings-get?id="+id, function(data, status){
          var arr = data.config.replace(/, +/g, ",").split(",").map(Number);
          toggleColConfig(arr, data.id);
      });
    }

    function toggleColConfig(config, opt) {
        var c = 0;
        table.ajax.reload();
        config.forEach(function(col) {
            table.column(c).visible(col);
            var colCaptEl = $("a[data-column='"+c+"']");
            c = c + 1;
            if (col == 0 && colCaptEl.hasClass('lead')) {
                colCaptEl.removeClass('lead');
            }
            if (col == 1 && !colCaptEl.hasClass('lead')) {
                colCaptEl.addClass('lead');
            }
        });
        //adjust menu
        var elCount = $("a.colconfig").length;
        for (i = 0; i < elCount; i++) {
            var optMenu = $("a.colconfig:eq("+i+")");
            var confId = optMenu.attr('config-col');
            if (confId == opt && !optMenu.hasClass("fa")) {
                optMenu.addClass('fa fa-check');
            } else {
                optMenu.removeClass('fa fa-check');
            }
        }
    };

</script>
@endsection
