@extends('layouts/master')

@section('title')
Search
@stop

@section('sidebar')
@stop

@section('content')
<div class="row">
@forelse($users as $user)
<div class="col-xs-4">
    <div class="row">
        <div class="col-xs-12">
            <img class="img-rounded profile-thumbnail" src='/2503ict-assign2/public/uploads/users/{{{ $user->email }}}/{{{ $user->profile_image }}}' title='N/A' alt='N/A'/>
        </div>
        <div class="col-xs-12">
            <h2><a href="{{ URL::to('/user/') }}/{{{ $user->id }}}">{{{ $user->fullname }}}</a><br/><small>Born: {{{ date("D M Y", strtotime($user->date_of_birth)) }}}</small></h2>
        </div>
    </div>
</div>
@empty
<div class="col-xs-12">No people found.</div>
@endforelse
</div>
@stop