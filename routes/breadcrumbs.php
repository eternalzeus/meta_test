<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Create Post
Breadcrumbs::for('create_post', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Create Post', route('createPost'));
});

// Home > Edit Post
Breadcrumbs::for('edit_post', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Edit Post');
});

// Home > View Post
Breadcrumbs::for('view_post', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Post');
});

// Address
Breadcrumbs::for('address', function (BreadcrumbTrail $trail) {
    $trail->push('Address', route('address'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});