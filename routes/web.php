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

Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function () {
    Route::get('/login', 'LoginController@login')->name('login');
    Route::post('/login', 'LoginController@postLogin')->name('login.post');
});

// , , 
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_account_enabled']], function () {
    
    Route::get('/logout', 'DashboardController@logout')->name('logout');
    Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('permission:user-list');
    // Route::resource('users', UserController::class);
    
    Route::get('/list', 'UserController@list')->name('user.list')->middleware('permission:user-list');
    Route::get('/show', 'UserController@show')->name('user.show')->middleware('permission:user-list');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store')->name('user.store');
    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/{id}/edit', 'UserController@update')->name('user.update');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/list', 'RoleController@list')->name('roles.list');
        Route::get('/create', 'RoleController@create')->name('roles.create');
        Route::post('/create', 'RoleController@store')->name('roles.store');
        Route::get('/{id}/edit', 'RoleController@edit')->name('roles.edit');
        Route::post('/{id}/edit', 'RoleController@update')->name('roles.update');
        Route::get('/{id}/destroy', 'RoleController@destroy')->name('roles.destroy');
    });
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/list', 'PermissionController@list')->name('permission.list');
        Route::get('/create', 'PermissionController@create')->name('permission.create');
        Route::post('/create', 'PermissionController@store')->name('permission.store');
        Route::get('/{id}/edit', 'PermissionController@edit')->name('permission.edit');
        Route::post('/{id}/edit', 'PermissionController@update')->name('permission.update');
        Route::get('/{id}/destroy', 'PermissionController@destroy')->name('permission.destroy');
    });
});


// Route::group(['prefix' => 'admin'], function () {
    
//     Route::get('/register', 'UserController@register')->name('user_register');
//     Route::post('/register', 'UserController@postRegister')->name('post_user_register');

//     Route::get('/create', 'UserController@create')->name('user_create');
// });

// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('users', UserController::class);
//     Route::resource('roles', RoleController::class);
//     Route::resource('permissions', PermissionController::class);
//     Route::resource('posts', PostController::class);
// });