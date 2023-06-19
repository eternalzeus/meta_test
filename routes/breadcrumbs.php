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

// All Address > User Address
Breadcrumbs::for('user_address', function (BreadcrumbTrail $trail) {
    $trail->parent('all_address');
    $trail->push('User Address', route('userAddress'));
});

// All Address > New Country
Breadcrumbs::for('new_country', function (BreadcrumbTrail $trail) {
    $trail->parent('all_address');
    $trail->push('New Country');
});

// All Address > New City
Breadcrumbs::for('new_city', function (BreadcrumbTrail $trail) {
    $trail->parent('all_address');
    $trail->push('New City');
});

// All Address > New District
Breadcrumbs::for('new_district', function (BreadcrumbTrail $trail) {
    $trail->parent('all_address');
    $trail->push('New District');
});

// All Address
Breadcrumbs::for('all_address', function (BreadcrumbTrail $trail) {
    $trail->push('All Address',route('allAddress'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});