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
		$data = Input::all();
		$title = $data['title'];
		$message = $data['message'];
		$privacy = $data['privacy'];
		
		$validator = Validator::make($data, Post::$rules);
	    
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		Post::create(array('user_id' => Auth::user()->id, 'title' => $title, 'message' => $message, 'privacy_setting' => $privacy));
			
		return Redirect::to(URL::previous());
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
		
		return View::make('post/show')
			->withPost($post)
			->withComments($post->comments()->orderBy('created_at', 'desc')->paginate(8))
			->with('viewing', true)
            ->with('isViewingPost','')
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
		return View::make('post/edit')->withPost($post);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$newPost = Input::all();
		
		$validator = Validator::make($newPost, Post::$rules);
	    
		if($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		
		$post = Post::find($id);
	
		if($post->user_id != Auth::user()->id) {
			return Redirect::to('/');
		}	
		
		$post->title = $newPost['title'];
		$post->message = $newPost['message'];
		$post->privacy_setting = $newPost['privacy'];
		$post->update();
		
		return Redirect::to("/post/$id");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		$post->comments()->delete();
		$post->delete($id);
		
		return Redirect::to('/');
	}


}
