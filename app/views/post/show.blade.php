@extends('layouts/master')

@section('title')
{{{ $post->Title }}}
@stop

@section('content')
<div class="row post">
    @include('post/post')
</div>
@stop