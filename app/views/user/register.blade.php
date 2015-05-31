@extends('layouts/master')

@section('title')
Registration
@stop

@section('content')
<div class="col-sm-12">
{{ Form::model($user, array('route'=>'user.register', 'files'=>'true')) }}
    @include('user/form')
    <button class="btn btn-primary">Register</button><a href="{{{ route('home.home') }}}" class="btn btn-link">Cancel</a>
{{ Form::close() }}
</div>
@stop