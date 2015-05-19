@extends('layouts/master')

@section('title')
Registration
@stop

@section('content')
<div class="col-sm-12">
    {{ Form::model($user, array('route'=>'user.register')) }}
    <div class="form-group">
        <label for="email">Email: </label>
        {{ Form::text('email', $user->email, array('class'=>'form-control', 'placeholder'=>'name@example.com')) }}
    </div>
    <div class="form-group">
        <label for="password">Password: </label>
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
    </div>
    <div class="form-group">
        <label for="name">Full name: </label>
        {{ Form::text('fullname', $user->fullname, array('class'=>'form-control', 'placeholder'=>"Enter your account's name here")) }}
    </div>
    <div class="form-group">
        <label for="profile-picture">Profile picture: </label>
        {{ Form::file('profile-picture', array('class'=>'form-control', 'A picture you want people to see...')) }}
    </div>
    <input type="submit" class="btn btn-primary" value="Register"/>
    <a href="{{ URL::asset('/') }}">Cancel</a>
    {{ Form::close() }}
</div>
@stop