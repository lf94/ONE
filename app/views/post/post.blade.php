<div class="modifiers">
    @if(!empty(Session::get('user')))
    @if($post->idUser == Session::get('user')->idUser)
    {{ Form::open(array('route' => array('post.destroy', $post->idPost), 'method' => 'delete', 'class' => 'single')) }}
    <button class="btn btn-link icon"><span class="glyphicon glyphicon-trash"></span></button>
    {{ Form::close() }}
    <a class="btn btn-link icon" href="{{ URL::route('post.edit', $post->idPost) }}"><span class="glyphicon glyphicon-pencil"></span></a>
    @endif
    @endif
</div>

<div class="col-sm-3 poster">
    <img class="img-thumbnail" src='{{{ $post->user()->ProfilePictureURL }}}' width='128' height='128' title='N/A' alt='N/A'/>
    <div><a href="{{ URL::route('user.show', $post->user()->idUser) }}">{{{ $post->user()->Name }}}</a></div>
</div>
<div class="col-sm-9 message">
    <div class='title'><h3>{{{ $post->Title }}}</h3></div>
    <div class='text'>{{{ $post->Message }}}</div>
</div>

<div class="col-sm-12"><hr/></div>

<?php 
    $comments = isset($comments) ? $comments : $post->comments();
    $n_comments = count($comments);
?>

@if(!isset($viewing) && $n_comments > 3)
<div class="col-sm-12 comments"><a href="{{ URL::route('post.show', $post->idPost) }}">View {{{ count($comments)-3 }}} more comments</a></div>
<?php $comments = array_splice($comments, $n_comments-3, $n_comments); ?>
@endif

@foreach($comments as $comment)
    <div class="col-sm-11 comment">
        <a href="{{ URL::to('/user/'.$comment->user()->idUser) }}">{{{ $comment->user()->Name }}}</a> says: {{{ $comment->Message }}}
    </div>
    <div class="col-sm-1 comment-modifier">
    @if(!empty(Session::get('user')))
    @if($comment->idUser == Session::get('user')->idUser)
    {{ Form::open(array('route' => array('comment.destroy', $comment->idComment), 'method' => 'delete', 'class' => 'single')) }}
        <input type="hidden" name="idPost" id="idPost" value="{{ $comment->idPost }}"/>
        <button class="btn btn-link icon"><span class="glyphicon glyphicon-trash"></span></button>
    {{ Form::close() }}
    @endif
    @endif
    </div>
@endforeach

@if(!empty($comments))
<div class="col-sm-12"><br/></div>
@endif

<div class="row">
    <div class="col-sm-12 comment-form">
       @include('comment/form')
    </div>
</div>