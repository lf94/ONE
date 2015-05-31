@extends ('layouts/master')

@section('title')
Modifying {{{ Auth::user()->fullname }}}'s account
@stop

@section('content')
<div class="col-sm-12">
{{ Form::model($user, array('route'=> array('user.update', Auth::user()->id), 'files'=>'true', 'method'=>'PUT')) }}
    @include('user/form')
    <input type="hidden" value="_put"/>
    <button class="btn btn-primary">Save</button><button class="btn btn-link">Cancel</button>
{{ Form::close() }}
</div>
@stop