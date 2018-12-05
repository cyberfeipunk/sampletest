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
Route::get('/test','TestController@test')->name('test');
Route::get('/home','StaticPagesController@home')->name('home');
Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');

//Route::get('signup','UsersController@create')->name('signup');

//users manage
Route::resource('users','UsersController');
//Route::get('/users','UsersController@index')->name('users');
//Route::get('/users/{user}','UsersController@show')->name('users.show');
//Route::get('/users/create','UsersController@create')->name('users.create');
//Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');
//Route::post('/users','UsersController@store')->name('users.store');
//Route::patch('/users/{user}','UsersController@update')->name('users.update');
//Route::delete('/users/{user}','UsersController@destroy')->name('users.distroy');
Route::get('/signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');
Route::get('/signup/resendconfirmemail/{user}','UsersController@resendConfirmEmail')->name('resendConfirmEmail');
//login && logout

Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');

//forget password reset password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('statuses','StatusesController@index')->name('statuses');
Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);

Route::get('users/{user}/followings','UsersController@followings')->name('users.followings');
Route::get('users/{user}/followers','UsersController@followings')->name('users.followers');

Route::post('followers/{user}','FollowersController@store')->name('followers.store');
Route::delete('followers/{user}','FollowersController@destroy')->name('followers.destroy');

Route::get('followers/{user}/followings','FollowersController@followings')->name('followers.followings');
Route::get('followers/{user}/followers','FollowersController@followers')->name('followers.followers');
