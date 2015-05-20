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
	
		$data = Input::all();
		
		$validator = Validator::make($data, Comment::$rules);
		
		if($validator->passes()) {
			Comment::create(["post_id"=>$data['post_id'], 'user_id'=>Auth::user()->id,'message'=>$data['message']]);
			return Redirect::to("/post/{$data['post_id']}");
		}
		
		return Redirect::back()->withErrors($validator)->withInput();
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
		$comment = Comment::find($id);
		if(empty($comment)) {
			return Redirect::back();
		}	
		
		if($comment->user_id != Auth::user()->id) {
			return Redirect::back();
		}
		
		Comment::destroy($id);
		return Redirect::back();
	}


}
