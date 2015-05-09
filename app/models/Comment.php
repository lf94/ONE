<?php
/**
 * A class to hold comment data.
 */
class Comment extends Eloquent {
    /**
     * Select the user who posted this comment.
     * @return A User object.
     */
    function user() {
        return $this->hasOne('User');
    }
    
    /**
     * Select the post that this comment belongs to.
     * @return A Post object
     */
    function post() {
        return $this->hasOne('Post');
    }
}

?>