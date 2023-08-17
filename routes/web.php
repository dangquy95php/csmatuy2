<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/login', 'UserController@postLogin')->name('login.post');
    
    
});

// , , 
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'permission:user-list']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/list', 'UserController@list')->name('user.list');
    Route::get('/show', 'UserController@show')->name('user.show');

    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
});


// Route::group(['prefix' => 'admin'], function () {
    
//     Route::get('/register', 'UserController@register')->name('user_register');
//     Route::post('/register', 'UserController@postRegister')->name('post_user_register');

//     Route::get('/create', 'UserController@create')->name('user_create');
// });

Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('users', UserController::class);
//     Route::resource('roles', RoleController::class);
//     Route::resource('permissions', PermissionController::class);
//     Route::resource('posts', PostController::class);
// });