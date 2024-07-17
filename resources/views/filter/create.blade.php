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
    <div class="col-lg-12">
        <h2>Filter</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('filterindex')}}">Filter</a>
            </li>
            <li class="active">
                <strong>Create New</strong>
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Filter Definition</h5>
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
              <form id="filterform" method="post" action="{{ route('createfilter') }}" class="form-horizontal" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Filter Name</label>
                              <input id="filtername" placeholder="Filter Name" type="text" class="form-control{{ $errors->has('filter_name') ? ' is-invalid' : '' }}" name="filter_name" value="{{ old('filter_name') }}" required autofocus>
                              @if ($errors->has('filter_name'))
                                  <span class="invalid-feedback">
                                  <strong>{{ $errors->first('filter_name') }}</strong>
                              </span>
                              @endif
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-group" id="selectFilterType">
                              <div>
                                  <label>Filter Type</label>
                                  <select id="filtertype" name="filter_type" class="form-control m-b">
                                      <option value="course_filter">Course Filter</option>
                                      <option value="topic_filter">Topic Filter</option>
                                      <!-- <option value="author_filter">Author Filter</option>

                                      <option value="keyword_filter">Keyword Filter</option> -->
                                  </select>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div id="builder-basic"></div>
                  </div>
                  <div class="row" style="margin-top: 20px;">
                      <div class="btn-group">
                          <a id="evalFilter" href="#" class="btn btn-info">Evaluate Filter</a>
                      </div>
                      <div class="btn-group">
                          <span id="evalText" style="margin-left: 20px;"></span>
                      </div>
                      <div class="btn-group pull-right">
                          <button id="saveFilter" type="submit" href="#" class="btn btn-primary">Save Filter</button>
                      </div>
                  </div>
              </form>
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
<script src="{{ asset('assets/js/webapp/filter-course.js?v=123') }}"></script>

<script>
$(document).ready(function(){
    reloadFilterDef();
});

</script>
@endsection
