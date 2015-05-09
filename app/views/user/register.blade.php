@extends('layouts/master')

@section('title')
Registration
@stop

@section('content')
<div class="col-sm-12">
<form action="{{ URL::to('/register') }}" method="post">
    <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" class="form-control" placeholder="Enter your account's name here"/>
    </div>
    <div class="form-group">
        <label for="profile-picture-url">Profile Picture: </label>
        <input type="text" name="profile-picture-url" class="form-control" placeholder="Enter an URL to a picture you want people to see..."/>
    </div>
    <input type="submit" class="btn btn-primary" value="Register"/>
    <a href="{{ URL::asset('/') }}">Cancel</a>
</form>
</div>
@stop