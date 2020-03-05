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

Route::get('/', 'PostsController@index')->name('top');

Route::resource('comments', 'CommentsController', ['only' => ['store']]);
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
//お気に入り
Route::get('posts/favorite/{post_id}','PostsController@setFavorite');
Route::get('posts/favorite/remove/{post_id}','PostsController@removeFavorite');
Route::get('/favoriteList','PostsController@viewFavorite');

//会員登録
Route::get('auth/register','Auth\RegisterController@showRegistrationForm');
Route::post('auth/register','Auth\RegisterController@register');
//ログイン
Route::get('auth/login','Auth\LoginController@showLoginForm');
Route::post('auth/login','Auth\LoginController@login');
//ログアウト
Route::get('auth/logout','Auth\LoginController@logout');
//退会
Route::get('auth/destroy','Auth\LoginController@destroy');



