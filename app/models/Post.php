<?php
/**
 * A post class that holds the title, message and the user who posted it.
 */
class Post extends Eloquent {
    /**
     * Select the user who posted this comment.
     * @return A User object.
     */
    function user() {
        return $this->belongsTo('User');
    }
    
    /**
     * Select all the comments that belong to this post.
     * @return A collection of Comment objects.
     */
    function comments() {
        return $this->hasMany('Comment');
    }
    
    
    /**
     * Determine if the post should be displayed, based on privacy settings, for this user.
     */
     function scopeViewableTo($query, $user) {
       return $query->where(function($query) use ($user) {
               $query = $query->where('privacy_setting','=','global')->orWhere('privacy_setting','public'); 
               
            	if(!empty($user)) {
                	$query = $query
                	->orWhere(function($query) use ($user) {
                	    $friendsList = $user->friends->lists('friend_id');
                	    array_push($friendsList, Auth::user()->id);
        	    		$query
        	    		->where('privacy_setting','=','friends')
        	    		->whereIn('user_id', $friendsList);
                	});
            	}
            	
            	if(Auth::check()) {
            	    $query = $query
                	->orWhere(function($query) {
                			$query
            	    		->where('privacy_setting','=','private')
            	    		->where('user_id', '=', Auth::user()->id);
                	});
            	}
           });
     }
     
     public function privacyIcon() {
         switch($this->privacy_setting) {
             case "public":
             case "global":
                 return "<span class='glyphicon glyphicon-globe'></span>";
             case "friends":
                 return "<span class='glyphicon glyphicon-user'></span>";
             case "private":
                 return "<span class='gyphicon glyphicon-ban-circle'></span>";
         }
         
         return "";
     }
     
     protected $fillable = array('user_id', 'title', 'message', 'privacy_setting');
     
     public static $rules = [
		    "title" => "required",
		    "message" => "required",
		    "privacy" => "required"
		   ];
}
?>