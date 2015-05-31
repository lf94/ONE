<?php
/**
 * A class that represents a one-way friendship.
 */
class Friend extends Eloquent {
    /* Fields that do not need to be specified when calling Friend::create() */
    protected $guarded = array('id','created_at','updated_at');
}
?>