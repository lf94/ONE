@if(Auth::check())
{{ Form::open(array('route' => array('comment.store'))) }}
    {{{ $errors->first('message') }}}
    <div class="input-group">
        <input type="text" class="form-control" name="message" id="message" placeholder="Type your comment..."/>
        <input type="hidden" name="post_id" id="idPost" value="{{{ $post->id }}}"/>
        <span class="input-group-btn">
            <button class="btn btn-secondary">Post</button>
        </span>
    </div>
{{ Form::close() }}
@endif