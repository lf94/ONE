<?php

class UserController extends BaseController {
    
    /**
     * Show a user's profile page.
     */
    public function show($id) {
        $user = User::find($id);
       $posts = Post::ViewableTo(Auth::user())->get(); 
       return View::make('user/show')
           ->with('otherUser', $user)
           ->with('posts', $posts);
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
		$email = $data['email'];
		$password = $data['password'];
		
		Session::forget('login_error');
	
	/*	
		$validator = Validator::make($data, array(
		    "email" => "required",
		    "password" => "required"
	    ));
	    
	    if($validator->fails()) {
			return Redirect::to(URL::previous());
	    } 
	 */   
		$success = Auth::attempt(array('email' => $email, 'password' => $password), true);
		
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
   
   /**
    * Friend a user.
    */
    public function friend($id) {
        Friend::create(array("user_id" => Auth::user()->id, "friend_id" => $id));
        return Redirect::to(URL::previous());
    }
    
   /**
    * Unfriend a user.
    */
    public function unfriend($id) {
        Friend::find($id);
        return Redirect::to(URL::previous());
    }
}