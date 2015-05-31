<?php

use Illuminate\Support\Collection;

class HomeController extends BaseController {
	
	/**
	 * Show all the posts (based on privacy) from the newest to oldest.
	 */
	public function home() {
        $posts = Post::ViewableTo(Auth::user())->orderBy('created_at', 'desc')->paginate(10); 
	    
	    
	    $lastMember = DB::select("SELECT id FROM users ORDER BY id DESC LIMIT 1;")[0]->id;
	    $lastPost = DB::select("SELECT id FROM posts ORDER BY id DESC LIMIT 1;")[0]->id;
	    $lastComment = DB::select("SELECT id FROM comments ORDER BY id DESC LIMIT 1;")[0]->id;
	    
		return View::make('home/home')
			->with('post', new Post())
			->with('lastMember',$lastMember)
			->with('lastPost',$lastPost)
			->with('lastComment',$lastComment)
			->withPosts($posts);
	}

}
?>