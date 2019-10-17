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

Route::get('/','ThreadController@index1');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/thread', 'ThreadController');

Route::resource('/comment','CommentController', ['only'=> ['update', 'destroy']]);
Route::post('comment/create/{thread}','CommentController@addThreadComment')->name('threadcomment.store');

Route::post('reply/create/{comment}', 'CommentController@addCommentReply')->name('replycomment.store');


Route::post('reply/destroy/{comment}', 'CommentController@destCommentReply')->name('replycomment.destroy');

Route::post('reply/update/{comment}', 'CommentController@updCommentReply')->name('replycomment.update');
Route::post('/thread/mark-as-solution','ThreadController@markAsSolution')->name('markAsSolution');

