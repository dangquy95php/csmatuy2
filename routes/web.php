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
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/login', 'UserController@postLogin')->name('post_login');
});

Route::group(['prefix' => 'admin'], function () {
    
    Route::get('/register', 'UserController@register')->name('user_register');
    Route::post('/register', 'UserController@postRegister')->name('post_user_register');

    Route::get('/list', 'UserController@list')->name('user_list');
    Route::get('/create', 'UserController@create')->name('user_create');
});
