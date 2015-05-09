<?php

class UserController extends BaseController {
    
    /**
     * Show a user's profile page.
     */
    public function show($id) {
        $otherUser = User::find($id);
        $postsArray = DB::select('SELECT * FROM Post WHERE idUser = ?;', array($otherUser->idUser));
        $postComments = DB::select('SELECT DISTINCT Post.idPost, Post.idUser, Post.Title, Post.Message FROM Post, Comment WHERE (Post.idPost = Comment.idPost AND Comment.idUser = ?) OR (Post.idUser = ?);', array($otherUser->idUser, $otherUser->idUser));
        
        $postsArray = $postComments;
        $postsObjects = array();
        
        foreach($postsArray as $post) {
            $postsObjects[] = Post::to($post);
        }
        
        $postsObjects = array_reverse($postsObjects);
        
        return View::make('user/show')
            ->with('otherUser', $otherUser)
            ->with('posts', $postsObjects);
    }
    
    /**
     * Register a user.
     */
    public function register() {
        $user = new User();
        $user->construct(NULL, Input::get('name'), Input::get('profile-picture-url'));
        $user->save();
        
        $user->idUser = User::last();
        
        Session::put('user', $user);
        
        return Redirect::to("/");
    }
    
    /**
     * Login a user.
     */
    public function login() {
		$data = Input::all();
		$username = $data['email'];
		$password = $data['password'];
		Session::forget('login_error');
		
		$validator = Validator::make($data, array(
		    "email" => "required",
		    "password" => "required"
	    ));
	    
	    if($validator->fails()) {
			return Redirect::to(URL::previous());
	    } 
	    
		$success = Auth::attempt(compact('email', 'password'));
		
		if($success) {
			return Redirect::to(URL::previous());
		}
		
		Session::put('login_error', 'Login failed.');
		
		return Redirect::route('home.home');
    }
    
    /**
     * Log a user out.
     */
    public function logout() {
		Auth::logout();
		return Redirect::route('home.home');
    }
}