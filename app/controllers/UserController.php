<?php

class UserController extends BaseController {
    
    /**
     * Show a user's profile page.
     */
    public function show($id) {
        $user = User::find($id);
        
       $postsQuery = $user->posts()->where('privacy_setting','=','public')->orWhere('privacy_setting','global'); 
    	 
    	if(!empty($user)) {
        	$postsQuery = $postsQuery
        	->orWhere(function($query) use ($user) {
    	    		$query
    	    		->where('privacy_setting','=','friends')
    	    		->whereIn('user_id', $user->friends->lists('friend_id'));
        	});
    	}
    	if(Auth::check()) {
    	    $postsQuery = $postsQuery
        	->orWhere(function($query) {
        			$query
    	    		->where('privacy_setting','=','private')
    	    		->where('user_id', '=', Auth::user()->id);
        	});
    	}
    	
        $posts = $postsQuery->get();
       
        $isFriend = false;
        
        if(Auth::check()) {
            $friend = Friend::where('user_id', Auth::user()->id)->where('friend_id', $id)->count();
            if($friend > 0) {
                $isFriend = true;
            }
        }
        
       return View::make('user/show')
           ->with('otherUser', $user)
           ->with('isFriend', $isFriend)
           ->with('posts', $posts);
    }
    
    /**
     * Register a user.
     */
    public function register() {
       $data = Input::all();
       $validator = Validator::make($data, User::$rules);
       
       if($validator->passes()) {
       
        $filename = "na.png";
        
        if(Input::hasFile('profile-picture')) {
            $image = Input::file('profile-picture');
            
            $uploadDirectory = public_path().User::$directory.'/'.$data['email'];
            $filename = $image->getClientOriginalName();
            File::makeDirectory($uploadDirectory, $mode=0755, $recursive=true);
            $image->move($uploadDirectory, $filename);
        }
        
        User::create(array(
            'email'=>$data['email'], 
            'password'=>Hash::make($data['password']),
            'fullname'=>$data['fullname'],
            'date_of_birth'=>$data['dob'],
            'profile_image'=>$filename
        ));
        
        return Redirect::to("/");
       }
      
        return Redirect::back()->withErrors($validator)->withInput();
    }
    
    /**
     * Login a user.
     */
    public function login() {
		$data = Input::all();
		$email = $data['email'];
		$password = $data['password'];
		
		Session::forget('login_error');
	
		$validator = Validator::make($data, User::$rules);
	    
	    if($validator->fails()) {
			return Redirect::to(URL::previous());
	    } 
	    
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
        if(Auth::check()) {
            $friend = Friend::where('user_id', Auth::user()->id)->where('friend_id',$id)->count();
            
            if($friend == 0) {
                /* I tried with Friend::create(...), no go... */
                
                $friendObj = new Friend();
                $friendObj->user_id = Auth::user()->id;
                $friendObj->friend_id = $id;
                $friendObj->save();
                
                $friendObj = new Friend();
                $friendObj->friend_id = Auth::user()->id;
                $friendObj->user_id = $id;
                $friendObj->save();
            }
        }
        return Redirect::to(URL::previous());
    }
    
   /**
    * Unfriend a user.
    */
    public function unfriend($id) {
        if(Auth::check()) {
           $friend = Friend::where('user_id', Auth::user()->id)->where('friend_id', $id);
           
           $isFriend = $friend->count(); 
            if($isFriend > 0) {
                $friend->delete();
                $friend = Friend::where('friend_id', Auth::user()->id)->where('user_id', $id);
                $friend->delete();
            }
        } 
        return Redirect::to(URL::previous());
    }
   
   /**
    * Search for users.
    */
    public function search() {
        $name = Input::get('person-name');
        $users = User::where('fullname', 'LIKE', "%$name%")->get();
        return View::make('user/list')->withUsers($users);
    }
}