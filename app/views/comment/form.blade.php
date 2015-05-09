@if(isset($user))
{{ Form::open(array('route' => array('comment.store'))) }}
    @if(isset($commentError))
    @if($commentError)
        <div class="bg-danger">Your comment was empty.</div>
    @endif
    @endif
    <div class="input-group">
        <input type="text" class="form-control" name="message" id="message" placeholder="Type your comment..."/>
        <input type="hidden" name="idPost" id="idPost" value="{{{ $post->idPost }}}"/>
        <span class="input-group-btn">
            <button class="btn btn-secondary">Post</button>
        </span>
    </div>
{{ Form::close() }}
@endif