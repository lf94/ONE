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
        return $this->hasOne('user');
    }
    
    /**
     * Select all the comments that belong to this post.
     * @return A collection of Comment objects.
     */
    function comments() {
        return $this->hasMany('comments');
    }
}
?>