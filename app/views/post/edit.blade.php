@extends ('layouts/master')

@section('title')
Editing a Post
@stop

@section('content')
<div class='col-sm-12'>
    {{ Form::model($post, array('route' => array('post.update', $post->id), 'method' => 'put')) }}
        @include('post/form')
        <input type="hidden" value="_put"/>
        <button class="btn btn-primary">Save</button><button class="btn btn-link">Cancel</button>
    {{ Form::close() }}
</div>
@stop