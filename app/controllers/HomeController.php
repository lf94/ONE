<?php

use Illuminate\Support\Collection;

class HomeController extends BaseController {
	public function home() {
        $posts = Post::ViewableTo(Auth::user())->orderBy('created_at', 'desc')->paginate(10); 
        
		return View::make('home/home')
			->with('post', new Post())
			->withPosts($posts);
	}

}
?>