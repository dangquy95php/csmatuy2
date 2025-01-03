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
    Route::get('/change-pass', 'UserController@changePass')->name('user.change-pass');
    Route::post('/change-pass', 'UserController@postChangePass');
    
    Route::get('/list', 'UserController@list')->name('user.list');
    Route::get('/list/log-password', 'UserController@listLogPassword')->name('user.list.log-password');
    
    Route::get('/show', 'UserController@show')->name('user.show');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store')->name('user.store');
    Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/{id}/edit', 'UserController@update')->name('user.update');
    Route::get('/{id}/destroy', 'UserController@destroy')->name('user.destroy');
    Route::get('/export', 'UserController@export')->name('user.export');
    

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
        Route::post('/staff', 'GateController@createStaff')->name('gate.create.staff');
        Route::post('/relatives-of-drug-addicts', 'GateController@relativesOfDrugAddicts')->name('gate.create.relatives_of_drug_addicts');
        Route::post('/guest-student', 'GateController@guestStudent')->name('gate.create.guest_student');
        
        Route::get('/note', 'GateController@note')->name('gate.note');
        Route::get('/note/create', 'GateController@noteCreate')->name('gate.note-create');
        Route::post('/note/create', 'GateController@noteStore')->name('gate.note-store');
        Route::get('/note/{id}/edit', 'GateController@noteEdit')->name('gate.note-edit');
        Route::post('/note/{id}/edit', 'GateController@noteUpdate')->name('gate.note-update');
        Route::get('/note/{id}/destroy', 'GateController@noteDestroy')->name('gate.note-destroy');

        Route::get('/index', 'GateController@index')->name('gate.index');
        Route::get('/input', 'GateController@input')->name('gate.input');
        Route::get('/search', 'GateController@search')->name('gate.search');
        Route::post('/add', 'GateController@add')->name('gate.add');
        Route::post('/update', 'GateController@update')->name('gate.update');
        Route::post('/end', 'GateController@end')->name('gate.end');

    });

    Route::group(['prefix' => 'permit'], function () {
        Route::get('/index', 'PermitController@index')->name('permit.index');
        Route::get('/create', 'PermitController@create')->name('permit.create');
        Route::post('/create', 'PermitController@store')->name('permit.store');
        Route::get('/{id}/edit', 'PermitController@edit')->name('permit.edit');
        Route::post('/{id}/edit', 'PermitController@update')->name('permit.update');
        Route::get('/{id}/destroy', 'PermitController@destroy')->name('permit.destroy');
    });

    Route::group(['prefix' => 'log'], function () {
        Route::get('/index', 'LogController@index')->name('log.index');
        Route::get('/create', 'LogController@create')->name('log.create');
        Route::post('/create', 'LogController@store')->name('log.store');
        Route::get('/{id}/edit', 'LogController@edit')->name('log.edit');
        Route::post('/{id}/edit', 'LogController@update')->name('log.update');
        Route::get('/{id}/destroy', 'LogController@destroy')->name('log.destroy');
    });
   
    Route::group(['prefix' => 'department'], function () {
        Route::get('/index', 'DepartmentController@index')->name('department.index');
        Route::get('/create', 'DepartmentController@create')->name('department.create');
        Route::post('/create', 'DepartmentController@store')->name('department.store');
        Route::get('/{id}/edit', 'DepartmentController@edit')->name('department.edit');
        Route::post('/{id}/edit', 'DepartmentController@update')->name('department.update');
        Route::get('/{id}/destroy', 'DepartmentController@destroy')->name('department.destroy');
    });

    Route::group(['prefix' => 'contest'], function () {
        Route::get('/index', 'ContestController@index')->name('contest.index');
        Route::get('/create', 'ContestController@create')->name('contest.create');
        Route::post('/create', 'ContestController@store');
        Route::get('/{id}/edit', 'ContestController@edit')->name('contest.edit');
        Route::post('/{id}/edit', 'ContestController@update')->name('contest.update');
        Route::get('/{id}/tested', 'ContestController@tested')->name('contest.tested');
        Route::get('/{id}/export', 'ContestController@export')->name('contest.export');
        
        Route::get('/{id}/law/question/index', 'LawController@question')->name('contest.law.question');
       
       
        // Route::get('/{id}/law/free', 'LawController@lawx')->name('contest.law.free');
        
        Route::get('/{id}/law/question/create', 'LawController@createQuestion')->name('law.question.create');
        Route::post('/{id}/law/question/create', 'LawController@createQuestionPost');

        Route::get('/{id}/law/question/edit', 'LawController@editQuestion')->name('law.question.edit');
        Route::post('/{id}/law/question/edit', 'LawController@updateQuestion')->name('law.question.update');

        
        Route::post('/{id}/law/question', 'LawController@createQuestionStore');

        Route::post('/{id}/law/question/update', 'LawController@updateQuestion')->name('contest.law.update');
        
    });

    Route::group(['prefix' => 'system-error'], function () {
        Route::get('/index', 'SystemErrorController@index')->name('system-error.index');
    });
});

Route::group(['middleware' => ['auth', 'is_account_enabled']], function () {

    Route::group(['prefix' => 'contest'], function () {
        Route::get('/{id}/law/confirm', 'User\LawController@confirm')->name('contest.law.confirm');
        Route::post('/{id}/law/confirm', 'User\LawController@confirmPost');
        Route::get('/{id?}/law', 'User\LawController@law')->name('contest.law');
        Route::post('/{id}/law', 'User\LawController@lawPost');
        Route::get('/{id}/law/result', 'User\LawController@lawResult')->name('law.result');

    });

    Route::group(['prefix' => 'email'], function () {
        Route::get('/index', 'User\EmailController@index')->name('email.index');
        Route::get('/create', 'User\EmailController@create')->name('email.create');
        Route::post('/create', 'User\EmailController@postCreate');

        Route::get('/sent', 'User\EmailController@sent')->name('email.sent');
        Route::post('/update-seen', 'User\EmailController@updateSeen')->name('email.update_seen');
        Route::get('/{id}/delete', 'User\EmailController@delete')->name('email.delete');
        Route::get('/trash', 'User\EmailController@trash')->name('email.trash');
    });
});

Route::get('/', 'User\HomeController@index');

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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
});
//Clear route cache:
Route::get('/route-cache', function() {
Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});
//Clear config cache:
Route::get('/config-cache', function() {
  Artisan::call('config:cache');
return 'Config cache has been cleared';
}); 
// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
return 'View cache has been cleared';
});

Route::get('/refresh-seed', function() {
    Artisan::call('migrate:refresh --seed');
});