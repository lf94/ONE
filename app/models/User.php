<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Defines what a user is.
 * A user has a name and an optional profile picture.
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	/* Rules for several different kinds of forms. */
	public static $rules = array(
		'email'=>'required|email|unique:users',
		'password'=>'required',
		'fullname'=>'required',
		'birthday'=>'required|date'
	);
	
	public static $loginRules = [
		'email'=>'required|email',
		'password'=>'required'
	];
	
	public static $updateRules = [
		'email'=>'email',
		'birthday'=>'date'
	];

	/* Directory related constants. */	
	public static $directory = '/uploads/users';
	public static $profilePicture = 'profile-picture';

	/* Eloquent variables */	
	protected $fillable = array('email','password','fullname','date_of_birth','profile_image');
	
	public function friends() {
		return $this->hasMany('Friend');	
	}
	
	public function posts() {
		return $this->hasMany('Post');
	}
}
?>