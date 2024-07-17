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
                <strong>Article</strong>
            </li>
        </ol>
    </div>
</div>

@endsection
