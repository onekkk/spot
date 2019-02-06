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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/add', 'AddController@index')->middleware('auth');
Route::post('/add', 'AddController@upload');
Route::get('/item_detail', 'ItemDetailController@index');
Route::get('/user_detail', 'UserDetailController@index');
Route::post('/follow', 'FollowController@upload');
Route::get('/follow_list', 'FollowController@index')->middleware('auth');
Route::post('/bookmark', 'BookMarkController@upload');
Route::get('/bookmark_list', 'BookMarkController@index')->middleware('auth');
Route::get('/profile', 'ProfileController@index')->middleware('auth');
Route::get('/profile_edit', 'ProfileEditController@index')->middleware('auth');
Route::post('/profile_edit', 'ProfileEditController@update')->middleware('auth');

