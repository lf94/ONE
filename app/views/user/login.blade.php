@extends('layouts/master')

@section('title')
Login
@stop

@section('nav-items')
@stop

@section('sidebar')
@stop

@section('content')
<div class="col-sm-12">
{{ Form::model($user, array('route'=>'user.login', 'files'=>'true')) }}
    <div class="form-group">
        <label for="name">Name: {{{ $errors->first('name') }}}</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your account's name here"/>
    </div>
    <div class="form-group">
        <label for="passowrd">Password: {{{ $errors->first('name') }}}</label>
        <input type="password" name="password" class="form-control" placeholder=""/>
    </div>
    <input type="submit" class="btn btn-primary" value="Login"/>
    <a href="{{ URL::asset('/') }}">Cancel</a>
{{ Form::close() }}
</div>
@stop