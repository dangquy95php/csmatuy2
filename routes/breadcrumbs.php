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
    $trail->push('Tài khoản nhân viên', route('user.list'));
});

Breadcrumbs::for('user.edit', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cập nhật nhân viên', route('user.edit'));
});