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

Route::get('/', 'HomeController@home');

Route::get('/document', array('as' => 'documents.show', function(){
    return View::make('document/index');
}));

Route::get('/register', function(){
    return View::make('user/register');
});
Route::post('/register', 'UserController@register');

Route::get('/login', function() {
    return View::make('user/login');
});
Route::post('/login', "UserController@login");

Route::get('/logout', "UserController@logout");




Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');
Route::resource('user', 'UserController');






?>