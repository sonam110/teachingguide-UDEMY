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
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <strong>Index</strong>
            </li>
            <a href="/filter/create" class="btn btn-primary pull-right">Create New Filter</a>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>List of Filter</h5>
            </div>
            <div class="ibox-content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Created</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($filter))
                        @foreach($filter as $f)
                        <tr>
                            <td>{{ $f->id }}</td>
                            <td>{{ $f->name }}</td>
                            <td>{{ $f->type }}</td>
                            <td>{{ date('m-d-Y', strtotime($f->created_at)) }}</td>
                            <td>
                                @if ($f->type == 'course_filter')
                                <a class="btn btn-success" type="button" href="{{ url('course-search?filter='.$f->id) }}"><i class="fa fa-calculator"></i> Results</a>
                                @elseif ($f->type == 'topic_filter')
                                <a class="btn btn-success" type="button" href="{{ url('topic-search?filter='.$f->id) }}"><i class="fa fa-calculator"></i> Results</a>
                                @endif
                                <a class="btn btn-info" type="button" href="{{ url('filter/'.$f->id.'/edit') }}"><i class="fa fa-sliders"></i> Edit</a>
                                <a class="btn btn-danger delete-button" type="button" filter-id="{{ $f->id }}"><i class="fa fa-trash"></i> <span class="bold">Delete</span></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function()
    {
        $(".delete-button").on("click", function()
        {
            var r = confirm("Are you sure you want to delete this Filter?");
            if (r == true) {
                var filter_id = $(this).attr('filter-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: '{{ env("APP_URL")."/filter/destroy/" }}'+filter_id,
                    data: {id: filter_id},
                    dataType: "JSON"
                }).done(function(result) {
                    console.log("success message here", result);

                    if(result.success == true) {
                        alert(result.message);
                        location.reload();
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>

@endsection
