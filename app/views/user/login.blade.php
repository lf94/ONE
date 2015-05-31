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
    
@if(isset($message))
<div class="form-group has-warning">
    <label>Invalid credentials.</label>
</div>
@endif

{{ Form::open(array('route'=>'user.login', 'files'=>'true')) }}
    <div class="form-group">
        <label for="email">Email: {{{ $errors->first('email') }}}</label>
        <input type="text" name="email" class="form-control" placeholder="Enter your account's email here"/>
    </div>
    <div class="form-group">
        <label for="password">Password: {{{ $errors->first('password') }}}</label>
        <input type="password" name="password" class="form-control" placeholder=""/>
    </div>
    <input type="submit" class="btn btn-primary" value="Login"/>
    <a href="{{ URL::asset('/') }}">Cancel</a>
{{ Form::close() }}
</div>
@stop