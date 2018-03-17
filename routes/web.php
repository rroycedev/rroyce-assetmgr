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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// Route::post('/dologin', '\App\Http\Controllers\Auth\LoginController@performLogin')->name("performlogin");

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UsersController@index')->name('user.list');
Route::get('/user/create', 'UsersController@create')->name('user.create');
Route::post('/user/store', 'UsersController@store')->name('user.store');
Route::post('/user/docreate', 'UsersController@doCreate')->name('user.docreate');

Route::get('/user/{uid}/edit', ['as' => 'user.edit', 'uses' => 'UsersController@edit']);
Route::post('/user/update', 'UsersController@update')->name('user.update');
// Route::get ( '/getusers', 'GetUsersController@readUsers' );
 Route::get ('/user/{uid}/destroy', 'UsersController@destroy' );

// Route::get('/password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

// Route::get('/exception', 'InternalErrorController@index')->name('exception');

