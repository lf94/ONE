<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home.home', 'uses'=>'HomeController@home'));

Route::get('/document', array('as' => 'documents.show', function(){
    return View::make('document/index');
}));

Route::get('/register', function(){
    return View::make('user/register')->withUser(new User());
});
Route::post('/register', array('as'=>'user.register','uses'=>'UserController@register'));

Route::get('/login', function() {
    return View::make('user/login');
});

Route::post('login', array("as" => "user.login", "uses" => "UserController@login"));
Route::get('logout', array("as" => "user.logout", "uses" => "UserController@logout"));
Route::post('search/users', array("as" => "user.search", "uses" => "UserController@search"));

Route::get('user/friend/{id}', array("as" => "user.friend", "uses" => "UserController@friend"));
Route::get('user/unfriend/{id}', array("as" => "user.unfriend", "uses" => "UserController@unfriend"));

Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');
Route::resource('user', 'UserController');
?>