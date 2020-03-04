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

#Route::get('/', function () {return view('welcome');});
Route::get('/', 'PostsController@index')->name('top');

Route::resource('posts', 'PostsController', ['only' => ['create', 'store']]);
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show']]);

Route::resource('comments', 'CommentsController', ['only' => ['store']]);
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update']]);
Route::resource('posts', 'PostsController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);

/*
Route::get('/home', function () {
    return redirect('/');
});
*/
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



