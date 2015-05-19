<div class="form-group">
    {{{ $errors->first('title') }}}<br/>
    <label for="title">Title:</label><br/>
    {{ Form::text('title', $post->title, array('placeholder' => 'Title of post...', 'class'=>'form-control')) }}
</div>
<div class="form-group">
    {{{ $errors->first('message') }}}<br/>
    <label for="message">Message:</label><br/>
    {{ Form::text('message', $post->message, array('placeholder' => 'Enter your message!', 'class'=>'form-control')) }}
</div>
<div class="form-group">
    {{{ $errors->first('privacy') }}}<br/>
    <label for="privacy">Privacy:</label><br/>
    {{ Form::select('privacy', array('public' => 'Public', 'friends' => 'Friends', 'private' => 'Private'), 'public', array('class'=>'form-control')) }}
</div>
