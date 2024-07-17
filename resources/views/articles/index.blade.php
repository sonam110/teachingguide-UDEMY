@extends('layouts.webapp')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Blog</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('articleindex')}}">Articles</a>
            </li>
            <li class="active">
                <strong>Index</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>List of Articles</h5>
            </div>
            <div class="ibox-content">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Views</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $k => $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ date('m-d-Y', strtotime($post->date)) }}</td>
                        <td>{{ $post->views }}</td>
                        <td>
                            <a class="btn btn-info" type="button" href="{{ url('post/'.$post->id.'/edit') }}"><i class="fa fa-paste"></i> Edit</a>
                            <a class="btn btn-warning delete-button" type="button" post-id="{{ $post->id }}"><i class="fa fa-warning"></i> <span class="bold">Delete</span></a>
                        </td>
                    </tr>
                    @endforeach
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
            var r = confirm("Are you sure you want to delete this post?");
            if (r == true) {
                var post_id = $(this).attr('post-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: '{{ env("APP_URL")."/post/destroy/" }}'+post_id,
                    data: {id: post_id},
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
