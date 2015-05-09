<?php

/*
	Decided to try out artisan controller:make for this one.
*/

class PostController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Not used
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Not used
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = Session::get('user');
		
		$title = Input::get('title');
		$message = Input::get('message');
		$titleError = false;
		$messageError = false;
		$error = false;
		
		if(empty($title)) {
			$titleError = true;
			$error = true;
		}
		
		if(empty($message)) {
			$messageError = true;
			$error = true;
		}
		
		if($error == true) {
			return Redirect::to('/')
				->with('postFormTitleError', $titleError)
				->with('postFormMessageError', $messageError);
		}
		
		
		
		$post = new Post();
		// Nonsense will be fixed after we're able to use Eloquent.
		$post->construct(NULL, $user->idUser, $title, $message);
		$post->save();
		
		return Redirect::to('/');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		$user = Session::get('user');
		$commentError = Session::get('commentError');
		if(empty($commentError)) {
			$commentError = false;
		}
		
		return View::make('post/show')
			->withPost($post)
			->withComments($post->comments())
			->withUser($user)
			->with('viewing', true)
			->with('commentError', $commentError);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);
		$user = Session::get('user');
		return View::make('post/edit')->withPost($post)->withUser($user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = Session::get('user');
		$post = new Post();
		$post->construct($id, $user->idUser, Input::get('title'), Input::get('message'));
		$post->update();
		
		return Redirect::to('/');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Delete all comments from the Post.
		$comments = Post::find($id)->comments();
		foreach($comments as $comment) {
			Comment::delete($comment->idComment);
		}
		// Delete the post.
		Post::delete($id);
		
		return Redirect::to('/');
	}


}
