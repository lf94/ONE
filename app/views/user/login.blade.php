@extends('layouts/master')

@section('title')
Registration
@stop

@section('nav-items')
@stop

@section('sidebar')
@stop

@section('content')
@if(isset($error))
<p class="bg-danger">Name was mistyped or doesn't exist. Try again.</p>
@endif
<div class="col-sm-12">
<form action="{{ URL::to('/login') }}" method="post">
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" class="form-control" placeholder="Enter your account's name here"/>
    </div>
    <input type="submit" class="btn btn-primary" value="Login"/>
    <a href="{{ URL::asset('/') }}">Cancel</a>
</form>
</div>
@stop