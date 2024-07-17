@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/querybuilder/query-builder.default.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="btn-group">
      <h2 class="webapp-header">Filter Home</h2>
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
                  <div id="builder-basic"></div>
              </div>
              <div class="row">
                  <div class="btn-group pull-right">
                      <button id="showFilter" href="#" class="btn btn-primary">Show Definition</button>
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
                <h5>Filter Results</h5>
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
<script src="{{ asset('assets/js/jQuery.extendext.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/doT/doT.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/querybuilder/query-builder.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
<script src="{{ asset('assets/js/webapp/filter.js?v=123') }}"></script>
<script src="{{ asset('assets/js/plugins/bootbox/bootbox.min.js') }}"></script>

<script>

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

</script>
@endsection
