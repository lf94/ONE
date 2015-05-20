@extends('layouts/master')

@section('title')
Registration
@stop

@section('content')
<div class="col-sm-12">
{{ Form::model($user, array('route'=>'user.register', 'files'=>'true')) }}
    @include('user/form')
    <button class="btn btn-primary">Register</button><button class="btn btn-link">Cancel</button>
{{ Form::close() }}
</div>
@stop