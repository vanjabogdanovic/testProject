<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'PostController@index')->name('home');
    Route::post('/home', 'PostController@createPost')->name('create_post');
    Route::get('/post/{id}', 'PostController@showPost')->name('post');
    Route::post('/post/{id}', 'PostController@editPost')->name('edit_post');
    Route::post('/home/{postId}/delete', 'PostController@deletePost')->name('delete_post');

    Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
    Route::post('/profile/{id}', 'ProfileController@updateProfile')->name('update_profile');

    Route::post('/post/{id}/comment', 'CommentController@createComment')->name('create_comment');
    Route::post('/home/post/comment/{id}', 'CommentController@editComment')->name('edit_comment');
    Route::post('/home/comment/delete/{id}', 'CommentController@deleteComment')->name('delete_comment');
});

