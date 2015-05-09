<div class="modifiers">
    @if(Auth::check())
    @if($post->user_id == Auth::user()->id)
    {{ Form::open(array('route' => array('post.destroy', $post->id), 'method' => 'delete', 'class' => 'single')) }}
    <button class="btn btn-link icon"><span class="glyphicon glyphicon-trash"></span></button>
    {{ Form::close() }}
    <a class="btn btn-link icon" href="{{ URL::route('post.edit', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
    @endif
    @endif
</div>

<div class="col-sm-3 poster">
    @if($post->user) User ID: {{$post->user->id}} @endif
</div>
<div class="col-sm-9 message">
    <div class='title'><h3>{{{ $post->title }}}</h3></div>
    <div class='text'>{{{ $post->message }}}</div>
</div>

<div class="col-sm-12"><hr/></div>

@if($post->comments()->count() > 0)
<div class="col-sm-12 comments"><a href="{{ URL::route('post.show', $post->id) }}">View {{{ $post->comments()->count() }}} comments</a></div>
@else
<div class="col-sm-12">No comments. <a href="" class="btn btn-link">Be the first.</a><br/></div>
@endif
