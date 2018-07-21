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

Route::get('/foo', function () {
    return 'Hello World';
});


Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function(){
	Route::resource('photos', 'PhotoController');
	Route::resource('gallery', 'GalleryController');
	Route::get('/', 'PhotoController@index');
	Route::get('register', 'Auth\RegisterController@adminregister')->name('admin.register');
});


Route::group(['middleware' => 'IsUser'], function(){
	Route::get('profile', 'UserController@index')->name('profile');
});


Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');


Route::get('/products', 'ProductController@index')->name('products');


// Route::get('gallery/showphotos', [
// 									'as' => 'gallery.showphotos', 
// 									'uses' => 'GalleryController@showphotos'
// 								  ]);








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
