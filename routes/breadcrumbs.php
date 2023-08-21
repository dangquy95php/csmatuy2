<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Trang chủ', route('dashboard'));
});

Breadcrumbs::for('user.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách nhân viên', route('user.list'));
});

Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('user.list');
    $trail->push('Chỉnh sửa nhân viên '. $user->username, route('user.edit', $user->id));
});

Breadcrumbs::for('roles.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách Roles', route('roles.list'));
});

Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.list');
    $trail->push('Thêm role', route('roles.create'));
});

Breadcrumbs::for('roles.edit', function ($trail, $roles) {
    $trail->parent('roles.list');
    $trail->push('Chỉnh sửa Role '. $roles->name, route('roles.edit', $roles->id));
});

Breadcrumbs::for('permission.list', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách permission', route('permission.list'));
});

Breadcrumbs::for('permission.create', function ($trail) {
    $trail->parent('permission.list');
    $trail->push('Thêm role', route('permission.create'));
});

Breadcrumbs::for('permission.edit', function ($trail, $permission) {
    $trail->parent('permission.list');
    $trail->push('Thêm role '. $permission->name, route('permission.edit', $permission->id));
});


// Breadcrumbs::for('user.edit', function ($trail) {
//     $trail->parent('dashboard');
//     $trail->push('Cập nhật nhân viên', route('user.edit'));
// });