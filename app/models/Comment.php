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
        return $this->belongsTo('User');
    }
    
    /**
     * Select the post that this comment belongs to.
     * @return A Post object
     */
    function post() {
        return $this->belongsTo('Post');
    }
    
    public static $rules = [
        "post_id"=>"required",
        'message'=>'required'
    ];
    
    protected $fillable = ["post_id","user_id","message"];
    
}

?>