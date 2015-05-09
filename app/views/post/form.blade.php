<div class="form-group">
    @if(!empty($postFormTitleError))
        <div class="bg-danger">A title for your post is required.</div>
    @endif
    <label for="title">Title:</label><br/>
    <input type="text" id="title" class="form-control" name="title" placeholder="Title of post" value="{{{ $postFormData->Title or '' }}}"/>
</div>
<div class="form-group">
    @if(!empty($postFormMessageError))
        <div class="bg-danger">You need a message for your post.</div>
    @endif
    <label for="message">Message:</label><br/>
    <textarea id="message" class="form-control" name="message" placeholder="Enter new message...">{{{ $postFormData->Message or '' }}}</textarea>
</div>
