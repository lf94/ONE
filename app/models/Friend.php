<?php
class Friend extends Eloquent {
    public function friend() {
        return User::find($this->friend_id);
    }
}
?>