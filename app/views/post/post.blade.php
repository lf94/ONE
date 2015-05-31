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
    <img class="img-thumbnail" src='/2503ict-assign2/public/uploads/users/{{{ $post->user->email }}}/{{{ $post->user->profile_image }}}' width="128" height="128" title='N/A' alt='N/A'/>
    <div><a href="{{ URL::route('user.show', $post->user->id) }}">{{{ $post->user->fullname }}}</a></div>
</div>
<div class="col-sm-9 message">
    <div class='title'><h3><a href="{{ URL::to('/post/'.$post->id) }}">{{{ $post->title }}}</a></h3></div>
    <div class='text'>{{{ $post->message }}}</div>
</div>

<div class="col-sm-12"><hr/></div>

@if(!isset($isViewingPost))
@if($post->comments()->count() > 0)
<div class="col-sm-12 comments"><a href="{{ URL::route('post.show', $post->id) }}">View {{{ $post->comments()->count() }}} comments</a><br/></div>
@else
<div class="col-sm-12">No comments. <a href="{{ URL::route('post.show', $post->id) }}" class="btn btn-link">Be the first.</a><br/></div>
@endif
@endif

@if(isset($isViewingPost))
<div class="row">
@forelse($comments as $comment)
    <div class="col-sm-11 comment">
        <a href="{{ URL::to('/user/'.$comment->user->id) }}">{{{ $comment->user->fullname }}}</a> says: {{{ $comment->message }}}
    </div>
    <div class="col-sm-1 comment-modifier">
    @if(Auth::check())
    @if($comment->user_id == Auth::user()->id)
    {{ Form::open(array('route' => array('comment.destroy', $comment->id), 'method' => 'delete', 'class' => 'single')) }}
        <button class="btn btn-link icon"><span class="glyphicon glyphicon-trash"></span></button>
    {{ Form::close() }}
    @endif
    @endif
    </div>
@empty
    <div class="col-sm-12"><br/></div>
@endforelse
</div>

<br/>

<div class="row">
    <div class="col-sm-12 comment-form">
       @include('comment/form')
    </div>
</div>

<div class="row">
       <div class="col-sm-12"> 
    {{ $comments->links() }}
    </div>
</div>
@endif