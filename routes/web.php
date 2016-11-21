<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','PostController@index');
Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

Route::group(['middleware' => ['auth']],function(){

// Route::get('/','HomeController@index');
// Route::get('/home', 'HomeController@index');

 // show new post form
 Route::get('new-post','PostController@create');
 // save new post
 Route::post('new-post','PostController@store');

  // edit post form
 Route::get('edit/{slug}','PostController@edit');

  // update post
 Route::post('update','PostController@update');
  // delete post
 Route::get('delete/{id}','PostController@destroy');

    // display user's all posts
	Route::get('my-all-posts','UserController@user_posts_all');
	// display user's drafts
	Route::get('my-drafts','UserController@user_posts_draft');


  // add comment
 Route::post('comment/add','CommentController@store');
 // delete comment
 Route::post('comment/delete/{id}','CommentController@distroy');

});
Auth::routes();

//users profile
Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');

// display single post
Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');

