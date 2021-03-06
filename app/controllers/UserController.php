<?php

class UserController extends BaseController {
    
    /**
     * Show a user's profile page.
     */
    public function show($id) {
        $user = User::find($id);
        
        $posts = $user->posts()->ViewableTo(Auth::user())->orderBy('created_at','desc')->paginate(10);
    	
        $querylog = DB::getQueryLog();
        //Uncomment to see the SQL
       // dd(end($querylog));
       
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
     * Display a form to modify the user's information.
     */
	public function edit($id)
	{
		return View::make('user/edit')->withUser(Auth::user());
	}

    /**
     * Update a user's information.
     */
	public function update($id) {
	    if($id != Auth::user()->id) {
	        return Redirect::back();
	    } 
	    
	    $data = Input::all();
	    $validator = Validator::make($data, User::$updateRules);
	    if($validator->passes()) {
	        
	        /* Check to see if the user is uploading a profile picture. */
            if(Input::hasFile('profile-picture')) {
                $image = Input::file('profile-picture');
               
                /* Make sure the user's directory doesn't already exist. */ 
                $uploadDirectory = public_path().User::$directory.'/'.$data['email'];
                $filename = $image->getClientOriginalName();
                if(!File::exists($uploadDirectory)) {
                    File::makeDirectory($uploadDirectory, $mode=0755, $recursive=true);
                }
                
                /* Make sure the user's image doesn't already exist. */
                if(!File::exists($uploadDirectory.$filename)) {
                    $image->move($uploadDirectory, $filename);
                }
                
                
    	        Auth::user()->profile_image = $filename;
            }
           
           /* Only update information that has been provided. */ 
	        if(Input::has('fullname')) { Auth::user()->fullname = $data['fullname']; }
	        if(Input::has('email')) { Auth::user()->email = $data['email']; }
	        if(Input::has('password')) { Auth::user()->password = Hash::make($data['password']); }
	        if(Input::has('birthday')) { Auth::user()->date_of_birth = $data['birthday']; }
	        
	        
	        Auth::user()->save();
	        return Redirect::to('/user/'.Auth::user()->id);
	    }
	    
	    return Redirect::back()->withErrors($validator)->withInput();
	}
    
    /**
     * Register a user.
     */
    public function register() {
       $data = Input::all();
       $validator = Validator::make($data, User::$rules);
       
       if($validator->passes()) {
       
        $filename = "na.png";
       
       /* Check to make sure the profile picture is being uploaded, and make sure their upload directory exists. */ 
        if(Input::hasFile('profile-picture')) {
            $image = Input::file('profile-picture');
            
            $uploadDirectory = public_path().User::$directory.'/'.$data['email'];
            $filename = $image->getClientOriginalName();
            if(!File::exists($uploadDirectory)) {
                File::makeDirectory($uploadDirectory, $mode=0755, $recursive=true);
            }
            $image->move($uploadDirectory, $filename);
        }
       
       /* Create the user. */ 
        $password = Hash::make($data['password']);
        
        User::create(array(
            'email'=>$data['email'], 
            'password'=>$password,
            'fullname'=>$data['fullname'],
            'date_of_birth'=>$data['birthday'],
            'profile_image'=>$filename
        ));
       
       /* Login the newly created user. */ 
		Auth::attempt(array('email' => $data['email'], 'password' => $data['password']), true);
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
		
		$validator = Validator::make($data, User::$loginRules);
	    
	    if($validator->fails()) {
			return Redirect::route('user.login')->withErrors($validator)->withInput();
	    } 
	    
		$success = Auth::attempt(array('email' => $email, 'password' => $password), true);
		
		if($success) {
			return Redirect::route('home.home');
		}
		
		return View::make('user.login')->withMessage(true);
    }
    
    /**
     * Log a user out.
     */
    public function logout() {
		Auth::logout();
		return Redirect::route('home.home');
    }
    
    
    /**
     * Show a list of this user's friends.
     */
    public function friends($id) {
        $user = User::find($id);
        $friends = User::whereIn('id', $user->friends()->lists('friend_id'))->get();
        return View::make('user/list')->withUsers($friends);
    }
   
   /**
    * Friend a user.
    */
    public function friend($id) {
        if(Auth::check()) {
            $friend = Friend::where('user_id', Auth::user()->id)->where('friend_id',$id)->count();
            
            if($friend == 0) {
                Friend::create(['user_id'=> Auth::user()->id, 'friend_id'=>$id]);
                Friend::create(['friend_id'=> Auth::user()->id, 'user_id'=>$id]);
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