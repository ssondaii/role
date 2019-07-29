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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/user', function(){
	return view('User');
})->name('user');

//user api
Route::resource('users','UserController');

//lay ra user hien tai, kem theo cac role cua user do
Route::get('/getCurrentUser',function(){
	return Auth::user()->load('roles');
});

//user logout
Route::match(['get', 'post'], '/logout', 'Auth\LoginController@logout')->name('logout');

//role management page
Route::get('/role', function(){
	return view('Role');
})->name('role');

//role api
Route::resource('roles', 'RoleController');

Route::get('/Admin_detailUser', function(){
	return view('Admin_detailUser');
})->name('Admin_detailUser');

Route::get('/user-page', function(){
	return view('UserPage');
})->name('userpage');

Route::get('/User_detailUser', function(){
	return view('User_detailUser');
})->name('User_detailUser');
