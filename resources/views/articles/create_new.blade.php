@extends('layouts.member')

@section('css')
    <link href="{{ asset('assets/css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Blog</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Dashboard</a>
            </li>
            <li>
                <a>Blog</a>
            </li>
            <li class="active">
                <strong>Create</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>New Blog Post <small>Simple login form example</small></h5>
            </div>
            
            <div class="ibox-content">
                <form method="post" action="{{ url('post') }}" class="form-horizontal" enctype="multipart/form-data">
                
                    @csrf
                    
                    <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ old('title') }}" name="title">

                            @if ($errors->has('title'))
                                <span class="invalid-feedback text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="slug">

                            @if ($errors->has('slug'))
                                <span class="invalid-feedback text-danger">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group" id="data_1">
                        <label class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-9"> 
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                
                                <input type="text" class="form-control" value="" name="date">
                                @if ($errors->has('date'))
                                    <span class="invalid-feedback text-danger">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-10">
                            <input class="tagsinput form-control" type="text" value="" name="tags"/>
                        </div>
                    </div>
                    
                    <div class="form-group ibox-content no-padding">
                        <textarea class="summernote form-control" name="body" rows="10"/></textarea>
                        <!-- <div class="summernote"></div> -->
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });

        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
    });
</script>
@endsection