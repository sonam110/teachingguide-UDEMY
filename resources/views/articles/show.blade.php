@extends('layouts.webapp')

@section('content')
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

<div class="wrapper wrapper-content  animated fadeInRight article">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="pull-right">
                    @foreach($post->tags as $tag)
                        <button class="btn btn-white btn-xs" type="button">{{ $tag->name }}</button>
                    @endforeach
                    </div>
                    <div class="text-center article-title">
                    <span class="text-muted"><i class="fa fa-clock-o"></i> {{ date('jS F Y', strtotime($post->date)) }}</span>
                        <h1>
                            {{ $post->title }}
                        </h1>
                    </div>
                    <p>
                        {!! $post->body !!}
                    </p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                                <h5>Tags:</h5>
                                @foreach($post->tags as $tag)
                                <button class="btn btn-white btn-xs" type="button">{{ $tag->name }}</button>
                                @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="small text-right">
                                <h5>Stats:</h5>
                                <div> <i class="fa fa-comments-o"> </i> {{ count($post->comments )}} comments </div>
                                <i class="fa fa-eye"> </i> {{ $post->views }} views
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <h2>Comments:</h2>

                            @foreach($post->comments as $comment)

                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <!-- <a href="" class="pull-left">
                                        <img alt="image" src="img/a1.jpg">
                                    </a> -->
                                    <div class="media-body">
                                        <a href="#">
                                            {{ $comment->user->name }}
                                        </a>
                                        <small class="text-muted">{{ date('l h:i a - m.d.Y', strtotime($comment->created_at)) }}</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>{!! $comment->comment !!}</p>
                                </div>
                            </div>

                            @endforeach

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <form method="post" action="{{ url('comment', $post->id) }}" class="form-horizontal">
                            @csrf
                            <h2>New comment:</h3>
                            <div class="form-group m-2">
                                <textarea class="form-control" name="comment" rows="5"/></textarea>
                            </div>
                            <div class="form-group m-2">
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function()
    {


        /* $(".delete-button").on("click", function()
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
        }); */
    });
</script>

@endsection
