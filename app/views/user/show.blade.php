@extends('layouts/master')

@section('title')
{{{ $otherUser->Name }}}
@stop


@section('sidebar')
<div class="col-sm-3">
    <div class="row">
        <div class="col-sm-12 poster">
            <img class="img-rounded profile-thumbnail" src='/2503ict-assign2/public/uploads/users/{{{ $otherUser->email }}}/{{{ $otherUser->profile_image }}}' title='N/A' alt='N/A'/>
            <div><h1><a href="{{ URL::route('user.show', $otherUser->id) }}">{{{ $otherUser->fullname }}}</a></h1></div>
        </div>
        @if(Auth::check())
        <div class="col-sm-12 text-center">
            <h3>Born: {{{ date("D M Y", strtotime($otherUser->date_of_birth)) }}}</h3>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(Auth::check())
            @if(Auth::user()->id != $otherUser->id)
            @if(!$isFriend)
            {{ Form::open(array('route'=>array('user.friend', $otherUser->id),'method'=>'PUT')) }}
            {{ Form::submit('Friend', array('class'=>'btn btn-secondary')) }}
            @else
            {{ Form::open(array('route'=>array('user.unfriend', $otherUser->id),'method'=>'DELETE')) }}
            {{ Form::submit('Unfriend', array('class'=>'btn btn-secondary')) }}
            @endif
            {{ Form::close() }}
            @endif
            @endif
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ URL::route('user.friends', $otherUser->id) }}"><span class="glyphicon glyphicon-user"></span> Friends</a>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="col-sm-9">
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
           <div class="col-sm-12"> 
        {{ $posts->links() }}
        </div>
    </div>
</div>
@stop