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

// All Country
Breadcrumbs::for('all_country', function (BreadcrumbTrail $trail) {
    $trail->push('All Country', route('allCountry'));
});

// All City
Breadcrumbs::for('all_city', function (BreadcrumbTrail $trail) {
    $trail->push('All City', route('allCity'));
});

// All District
Breadcrumbs::for('all_district', function (BreadcrumbTrail $trail) {
    $trail->push('All District', route('allDistrict'));
});

// All Country > New Country
Breadcrumbs::for('new_country', function (BreadcrumbTrail $trail) {
    $trail->parent('all_country');
    $trail->push('New Country');
});

// All City > New City
Breadcrumbs::for('new_city', function (BreadcrumbTrail $trail) {
    $trail->parent('all_city');
    $trail->push('New City');
});

// All District > New District
Breadcrumbs::for('new_district', function (BreadcrumbTrail $trail) {
    $trail->parent('all_district');
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

// Edit Country

Breadcrumbs::for('edit_country', function (BreadcrumbTrail $trail) {
    $trail->parent('all_country');
    $trail->push('Edit Country');
});

// Edit City

Breadcrumbs::for('edit_city', function (BreadcrumbTrail $trail) {
    $trail->parent('all_city');
    $trail->push('Edit City');
});

// Edit District

Breadcrumbs::for('edit_district', function (BreadcrumbTrail $trail) {
    $trail->parent('all_district');
    $trail->push('Edit District');
});

// All Product
Breadcrumbs::for('all_product', function (BreadcrumbTrail $trail) {
    $trail->push('All Product', route('allProduct'));
});

// All Product > New Product
Breadcrumbs::for('new_product', function (BreadcrumbTrail $trail) {
    $trail->parent('all_product');
    $trail->push('New Product');
});

// All Product > Edit Product
Breadcrumbs::for('edit_product', function (BreadcrumbTrail $trail) {
    $trail->parent('all_product');
    $trail->push('Edit Product');
});