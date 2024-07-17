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

        @foreach($posts as $post)
            <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <a href="{{ url('/articles', $post->slug) }}" class="btn-link">
                        <h2>
                            {{ $post->title }}
                        </h2>
                    </a>
                    <div class="small m-b-xs">
                        <strong>{{ $post->user->name }}</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ date('jS F Y', strtotime($post->date)) }}</span>
                    </div>
                    <p>
                        {!! str_limit($post->body, 200) !!}
                    </p>
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
                                <div> <i class="fa fa-comments-o"> </i> {{ count($post->comments) }} comments </div>
                                <i class="fa fa-eye"> </i> {{ $post->views }} views
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endforeach

        </div>
    </div>
</div>

@endsection
