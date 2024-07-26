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

Breadcrumbs::for('user.create', function ($trail) {
    $trail->parent('user.list');
    $trail->push('Tạo cán bộ', route('user.create'));
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

Breadcrumbs::for('gate.create', function ($trail) {
    $trail->push('Tạo phiếu ra vào cổng',  route('gate.create'));
});

Breadcrumbs::for('gate.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách ra vào cổng', route('gate.index'));
});

Breadcrumbs::for('gate.note', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách thẻ ghi chú', route('gate.note'));
});

Breadcrumbs::for('gate.note_edit', function ($trail, $note) {
    $trail->parent('gate.note');
    $trail->push('Chỉnh sửa thẻ ghi chú '. $note->name, route('gate.note-edit', $note->id));
});

Breadcrumbs::for('gate.note_create', function ($trail) {
    $trail->parent('gate.note');
    $trail->push('Tạo thẻ ghi chú',  route('gate.note-create'));
});

Breadcrumbs::for('team.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách các phòng/khu', route('team.index'));
});

Breadcrumbs::for('team.create', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tạo khu', route('team.create'));
});

Breadcrumbs::for('team.edit', function ($trail, $teams) {
    $trail->parent('team.index');
    $trail->push('Chỉnh sửa Phòng/Khu '. $teams->name, route('team.edit', $teams->id));
});

Breadcrumbs::for('permit.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Danh sách phép', route('permit.index'));
});

Breadcrumbs::for('permit.create', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tạo phép', route('permit.create'));
});


// Breadcrumbs::for('user.edit', function ($trail) {
//     $trail->parent('dashboard');
//     $trail->push('Cập nhật nhân viên', route('user.edit'));
// });