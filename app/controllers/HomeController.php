<?php

use Illuminate\Support\Collection;

class HomeController extends BaseController {
	public function home() {
        $posts = Post::ViewableTo(Auth::user())->paginate(2); 
        
		return View::make('home/home')
			->with('post', new Post())
			->withPosts($posts);
	}

}
?>