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
    	$postsQuery = $query->where('privacy_setting','=','global'); 
    	/*
    	if(!empty($user)) {
        	$postsQuery
        	->orWhere(function($query) use ($user) {
    	    		$query
    	    		->where('privacy_setting','=','friends')
    	    		->whereIn('user_id', $user->friends->lists('friend_id'));
        	});
    	}
    	if(Auth::check()) {
    	    $postsQuery
        	->orWhere(function($query) {
        			$query
    	    		->where('privacy_setting','=','private')
    	    		->where('user_id', '=', Auth::user()->id);
        	});
    	}
		*/
        return $postsQuery;
     }
}
?>