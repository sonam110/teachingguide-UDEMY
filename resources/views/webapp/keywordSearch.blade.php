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
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="btn-group">
      <h2 class="webapp-header">Keyword Analytics</h2>
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
                            <div class="col-md-8"><h4>Filters</h4>
                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group" id="selectTraffic">
                                      <div>
                                        <select id="selUTraffic" data-placeholder="All Udemy Traffic Levels" class="select2_traffic form-control m-b" multiple="multiple">
                                          <option value="All">No specific</option>
                                          <option value="5">5 - Very High Traffic</option>
                                          <option value="4">4 - High Traffic</option>
                                          <option value="3">3 - Medium Traffic</option>
                                          <option value="2">2 - Low Traffic</option>
                                          <option value="1">1 - Very Low Traffic</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group" id="selectTopic">
                                      <div>
                                        <select id="selTopic" data-placeholder="All Topics" class="select2_topic form-control m-b" multiple="multiple"></select>
                                      </div>
                                    </div>
                                    <div class="form-group" id="selectUTrend">
                                      <div>
                                        <select id="selUTrend" data-placeholder="All Udemy Trend Levels" class="select2_utrend form-control m-b" multiple="multiple">
                                          <option value="All">No specific</option>
                                          <option value="2">2 - Strong Growth</option>
                                          <option value="1">1 - Growth</option>
                                          <option value="0">0 - Neutral</option>
                                          <option value="-1">-1 - Decline</option>
                                          <option value="-2">-2 - Strong Decline</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group" id="selectTrend12m">
                                      <div>
                                        <select id="selGTrend" data-placeholder="All Google Trend Levels" class="select2_trend12m form-control m-b" multiple="multiple">
                                          <option value="All">No specific</option>
                                          <option value="2">2 - Strong Growth</option>
                                          <option value="1">1 - Growth</option>
                                          <option value="0">0 - Neutral</option>
                                          <option value="-1">-1 - Decline</option>
                                          <option value="-2">-2 - Strong Decline</option>
                                        </select>
                                      </div>
                                    </div>

                                  </div>

                                  <div class="col-md-6">
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
                                              <div id="ionrange_ratings"></div>
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
                          <a class="toggle-vis lead" data-column="0">Keyword</a> -
                          <a class="toggle-vis lead" data-column="1">Topic</a> -
                          <a class="toggle-vis lead" data-column="2">Relevance</a> -
                          <a class="toggle-vis lead" data-column="3">Category</a> -
                          <a class="toggle-vis lead" data-column="4">Udemy Traffic</a> -
                          <a class="toggle-vis lead" data-column="5">Google Traffic</a> -
                          <a class="toggle-vis" data-column="6">Google CPC</a> -
                          <a class="toggle-vis" data-column="7">Google Competition</a> -
                          <a class="toggle-vis" data-column="8">Ahref Difficulty</a> -
                          <a class="toggle-vis" data-column="9">Ahref CPS</a> -
                          <a class="toggle-vis lead" data-column="10">Reviews</a> -
                          <a class="toggle-vis lead" data-column="11">Usage</a> -
                          <a class="toggle-vis lead" data-column="12">Rating</a> -
                          <a class="toggle-vis lead" data-column="13">Students</a> -
                          <a class="toggle-vis lead" data-column="14">Google Trend 12m</a> -
                          <a class="toggle-vis lead" data-column="15">Google Trend 5y</a> -
                          <a class="toggle-vis lead" data-column="16">Opportunity</a> -
                          <a class="toggle-vis lead" data-column="17">Udemy Link</a>
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
                    <table id="keywordtable" class="footable table table-stripped toggle-arrow-tiny">
                    <thead>
                    <tr>
                        <th data-toggle="tooltip">Keyword</th>
                        <th data-toggle="tooltip">Topic</th>
                        <th data-toggle="tooltip">Relevance</th>
                        <th data-toggle="tooltip">Category</th>
                        <th data-toggle="tooltip">UTraffic</th>
                        <th data-toggle="tooltip">GTraffic</th>
                        <th data-toggle="tooltip">GCPC</th>
                        <th data-toggle="tooltip">GComp</th>
                        <th data-toggle="tooltip">KD</th>
                        <th data-toggle="tooltip">CPS</th>
                        <th data-toggle="tooltip">Reviews</th>
                        <th data-toggle="tooltip">Usage</th>
                        <th data-toggle="tooltip">Rating</th>
                        <th data-toggle="tooltip">Students</th>
                        <th data-toggle="tooltip">Trend (12m)</th>
                        <th data-toggle="tooltip">Trend (5y)</th>
                        <th data-toggle="tooltip">Opportunity</th>
                        <th data-toggle="tooltip">Udemy</th>
                    </tr>
                    </thead>
                    <tbody id="keyword-info">

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
    <h2 class='md-display-4'>Compete - Subscription</h2>
    <a class="caption-link trbg" href="/account" role="button">Upgrade Now</a>
    @if(!empty(Auth::user()->trial_ends_at))
    <a class="caption-link affiliate-link trbg" href="/account?tab=affiliate" role="button">Additional 7 days of free trial</a>
    @endif
</div>
<?php use App\Http\Controllers\MemberController;?>
<input type="hidden" id="inCurrentPlan" value="{{ MemberController::hasCompete() }}" />
@endsection


@section('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/webapp/keywordSearch_tour.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>

<script>
    var table;
    var reviewsFrom, reviewsTo;
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

    function setTitleTooltip() {
        $('#keywordtable th').each(function() {
          var title = $(this).text();
          var tooltip = '';
          switch (title) {
            case 'Keyword': tooltip = 'The keyword being searched for on Udemy.'; break;
            case 'Topic': tooltip = 'The dominant (but not exclusive) topic for this keyword.'; break;
            case 'Relevance': tooltip = 'The keyword relevance for the dominant- or selected topic in filter settings. Relevance is determined based on keyword rankings.'; break;
            case 'Category': tooltip = 'The most relevant category for this keyword based on high ranking courses.'; break;
            case 'UTraffic': tooltip = 'The estimated traffic category based on expected search volumes on Udemy. 5 being the most frequently searched for.'; break;
            case 'GTraffic': tooltip = 'The estimated traffic category on Google Search. 5 being the most frequently searched for.'; break;
            case 'GCPC': tooltip = 'Cost per Click in Google Adwords as being relevant for your own promotions.'; break;
            case 'GComp': tooltip = 'Competition Index from google for this keyword.'; break;
            case 'KD': tooltip = 'Keyword Difficulty is an estimate of how hard it would be to rank in Top10 Google search results for a given keyword. It is measured on a non-linear scale from 0 to 100 (low difficulty to high difficulty).'; break;
            case 'CPS': tooltip = 'Clicks Per Search (or CPS) shows how many different search results people click on average after performing a search for this keyword.'; break;
            case 'Reviews': tooltip = 'The review count for the top ranking course for this keyword.'; break;
            case 'Usage': tooltip = 'How often is the keyword being used in title and subtitle for the top ranking course for this keyword.'; break;
            case 'Rating': tooltip = 'The rating for the top ranking course for this keyword.'; break;
            case 'Students': tooltip = 'The amount of enrolled students for the top ranking course for this keyword.'; break;
            case 'Trend (12m)': tooltip = 'The google trend information over the last 12 month by week gives you solid information the current trend and attractiveness of the keyword. You can sort the column as well.'; break;
            case 'Trend (5y)': tooltip = 'The google trend information over the last 5 years by quarter should give you solid information about the overall trend and attractiveness of the keyword. You can sort the column as well.'; break;
            case 'Opportunity': tooltip = 'The opportunity score is a calculated index based on demand (search-traffic), competition (reviews and ratings) and trend (google).'; break;
            case 'Udemy': tooltip = 'External link to udemy keyword result page.'; break;
          }

          this.setAttribute( 'title', tooltip );
        });
    }

    $(document).ready(function(){
        var check = $("#inCurrentPlan").val();
        if (check == 0) {
            $(".secoverlay").show();
        }

        table = $('#keywordtable').DataTable({
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
                "url": "{{ route('keywordData') }}",
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
                    d.Topic = $('#selTopic').val();
                    d.minReviews = reviewsFrom;
                    d.minRating = ratingsFrom;
                    d.maxReviews = reviewsTo;
                    d.maxRating = ratingsTo;
                    d.minStudents = studentsFrom;
                    d.maxStudents = studentsTo;
                    //d.Traffic = $('#selTraffic').val();
                    d.UTraffic = $('#selUTraffic').val();
                    d.UTrend = $('#selUTrend').val();
                    d.Trend12m = $('#selGTrend').val();
                }
            },
            "order": [[16, "desc" ]],
            "columns": [
              {"data": "keyword"},
              {"data": "topic"},
              {"data": "relevance"},
              {"data": "category"},
              {"data": "utraffic"},
              {"data": "gtraffic"},
              {"data": "gCPC", "visible": false},
              {"data": "gCompetition", "visible": false},
              {"data": "kd", "visible": false},
              {"data": "cps", "visible": false},
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
              {"data": "usage"},
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
              {"data": "gtrend12m"},
              {"data": "gtrend"},
              {"data": "opportunity"},
              {"data": "link"}
            ],
             "columnDefs": [{
                 "targets": [18], // column or columns numbers
                 "orderable": false,  // set orderable for selected columns
             }],
             "columnDefs": [
               { "orderSequence": [ "desc", "asc"], "targets": [ 2,4,5,6,7,9,10,11,12,13,14,15,16,17 ] },
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
            setTitleTooltip();
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

        setTitleTooltip();

        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });

        $('#read-data').on('click', function(){
            table.ajax.reload();
        });


        $('#selTopic, #selUTraffic, #selUTrend, #selGTrend, #includeTags, #excludeTags, #IncKeyRel, .i-checks').on('change', function(e){
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

    $('.chosen-select').chosen({width: "100%"});
    $('.select2_traffic').select2();
    $('.select2_utrend').select2();
    $('.select2_trend12m').select2();
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
    $("#ionrange_reviews").ionRangeSlider({
        min: 0,
        max: 1000,
        step: 10,
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
