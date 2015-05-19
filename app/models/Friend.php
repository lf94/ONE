<?php
class Friend extends Eloquent {
    public function friend() {
        return User::find($this->friend_id);
    }
     protected $fillable = array('user_id', 'friend_id'); 
}
?>