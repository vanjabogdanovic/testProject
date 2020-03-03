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
    Route::get('/posts/{id}', 'PostController@showPost')->name('post');
    Route::post('/posts/{id}/edit', 'PostController@editPost')->name('edit_post')->middleware('post.owner');
    Route::post('/posts/{id}/delete', 'PostController@deletePost')->name('delete_post')->middleware('post.owner');

    Route::get('/profiles/{id}', 'ProfileController@index')->name('profile');
    Route::post('/profiles/{id}', 'ProfileController@updateProfile')->name('update_profile');
    Route::post('/image/{id}/delete', 'ProfileController@deleteImg')->name('delete_img');

    Route::post('/comments/{id}/create', 'CommentController@createComment')->name('create_comment');
    Route::post('/comments/{id}/edit', 'CommentController@editComment')->name('edit_comment')->middleware('comment.owner');
    Route::post('/comments/{id}/delete', 'CommentController@deleteComment')->name('delete_comment')->middleware('comment.owner');
});

