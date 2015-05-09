<?php
class HomeController extends BaseController {
	public function home() {
		$posts = Post::all(); 
		
		return View::make('home/home')
			->withPosts($posts);
	}

}
?>