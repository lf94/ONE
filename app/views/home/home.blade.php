@extends('layouts/master')

@section('title')
ONE
@stop

@section('nav-items')

@stop

@section('sidebar')
<div class="col-sm-3">
    @if(!Auth::check())
        <h3>What's going on...</h3>
        ONE now consists of <strong>{{{ $lastMember or '0' }}}</strong> people who have made <strong>{{{ $lastComment or '0' }}}</strong> comments to <strong>{{{ $lastPost or '0' }}}</strong> posts!
    @else
        {{ Form::model($post, array('route' => array('post.store'))) }}
            @include('post/form')
            {{ Form::submit('Post', array('class'=>"btn btn-primary")) }}
        {{ Form::close() }}
    @endif
</div>
@stop

@section('content')
<div class="col-sm-9">
@if(!Auth::check())
<div class="row">
    <div class="jumbotron">
    <h1>Welcome!</h1>
    <p class="sidebar-paragraph">
    You have arrived at ONE.
    </p>
    <p class="sidebar-paragraph">
        ONE is a social network created to connect people. And get me through this course. I'll probably use it afterwards too.
        It is built with Laravel 4.2, a PHP framework based on principles from Ruby on Rails. 
    </p>
    <p>
        If you would like to participate in ONE, <a class="btn btn-primary btn-lg" href="{{ URL::to('/register') }}">Register now!</a>
    </p>
    </div>
</div>
@endif

@forelse ($posts as $post)
<div class="row post thumbnail">
    @include('post/post')
    
</div>
@empty
    <div class="row thumbnail">
        <div class="col-sm-12">
            Sorry, there are no posts to display!
        </div>
    </div>
@endforelse

<div class="row">
    <div class="col-xs-12">
        {{ $posts->links() }}
    </div>
</div>
</div>

@stop