@extends('layouts/master')

@section('title')
{{{ $otherUser->Name }}}
@stop


@section('sidebar')
<div class="col-sm-3">
    <div class="row">
        <div class="col-sm-12 poster">
            <img class="img-rounded profile-thumbnail" src='{{{ $otherUser->ProfilePictureURL }}}' title='N/A' alt='N/A'/>
            <div><a href="{{ URL::route('user.show', $otherUser->id) }}">{{{ $otherUser->fullname }}}</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @if(Auth::check())
            @if(!$isFriend)
            {{ Form::open(array('route'=>array('user.friend', $otherUser->id),'method'=>'GET')) }}
            {{ Form::submit('Friend', array('class'=>'btn btn-secondary')) }}
            @else
            {{ Form::open(array('route'=>array('user.unfriend', $otherUser->id),'method'=>'GET')) }}
            {{ Form::submit('Unfriend', array('class'=>'btn btn-secondary')) }}
            @endif
            {{ Form::close() }}
            @endif
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
</div>
@stop