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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_account_enabled']], function () {
    Route::group(['prefix' => 'excel'], function () {
        Route::get('/import', 'ExcelImportController@import')->name('excel.import');
        Route::post('/import', 'ExcelImportController@postImport');
    });

    Route::get('/logout', 'DashboardController@logout')->name('logout');
    Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('permission:user-list');
    // Route::resource('users', UserController::class);

    
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::post('/profile', 'UserController@postProfile');
    Route::get('/list', 'UserController@list')->name('user.list');
    Route::get('/show', 'UserController@show')->name('user.show');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store')->name('user.store');
    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/{id}/edit', 'UserController@update')->name('user.update');
    Route::get('/{id}/destroy', 'UserController@destroy')->name('user.destroy');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/list', 'RoleController@index')->name('roles.list');
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

    Route::group(['prefix' => 'team'], function () {
        Route::get('/index', 'TeamController@index')->name('team.index');
        Route::get('/create', 'TeamController@create')->name('team.create');
        Route::post('/create', 'TeamController@store')->name('team.store');
        Route::get('/{id}/edit', 'TeamController@edit')->name('team.edit');
        Route::post('/{id}/edit', 'TeamController@update')->name('team.update');
        Route::get('/{id}/destroy', 'TeamController@destroy')->name('team.destroy');
    });

    Route::group(['prefix' => 'gate'], function () {
        Route::get('/create', 'GateController@create')->name('gate.create');
        Route::post('/staff', 'GateController@createStaff')->name('gate.create.staff');
        Route::post('/relatives-of-drug-addicts', 'GateController@relativesOfDrugAddicts')->name('gate.create.relatives_of_drug_addicts');
        Route::post('/guest-student', 'GateController@guestStudent')->name('gate.create.guest_student');
        
        Route::get('/index', 'GateController@index')->name('gate.index');
        Route::get('/note', 'GateController@note')->name('gate.note');
        Route::get('/note/create', 'GateController@noteCreate')->name('gate.note-create');
        Route::post('/note/create', 'GateController@noteStore')->name('gate.note-store');
        Route::get('/note/{id}/edit', 'GateController@noteEdit')->name('gate.note-edit');
        Route::post('/note/{id}/edit', 'GateController@noteUpdate')->name('gate.note-update');
        Route::get('/note/{id}/destroy', 'GateController@noteDestroy')->name('gate.note-destroy');
    });
});

Route::get('/', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

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