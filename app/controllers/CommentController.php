<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Not used
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Not used
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = Session::get('user');
		$idPost = Input::get('idPost');
		$message = Input::get('message');
		$commentError = false;
		
		if(empty($message)) {
			$commentError = true;
		} else {
			$comment = new Comment();
			$comment->construct(NULL, $user->idUser, $message, $idPost);
			$comment->save();
		}
		
		return Redirect::to("/post/$idPost")->with('commentError', $commentError);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Not used
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Not used
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Not used
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$idPost = Input::get('idPost');
		
		Comment::delete($id);
		return Redirect::to("/post/$idPost");
	}


}
