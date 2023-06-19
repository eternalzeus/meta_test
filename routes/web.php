<?php

use App\Models\Post;
use App\Http\Controllers\AddressController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes for login, logout and register

Route::post('/register',[UserController::class,'register']);
Route::get('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);
Route::get('/register_page',function(){
    return view(view:'user.register_page');
});
Route::get('/login_page',function(){
    return view(view:'user.login_page');
});

// Blog post related routes

Route::group(['middleware' => ['check_login']], function () {
	
	// Post routes
	Route::get('/', [UserController::class,'home'])->name('home'); // Home
	Route::get('/create-post',[PostController::class,'getPost'])->name('createPost'); // View create post
	Route::post('/create-post',[PostController::class,'createPost']);	// Create post
	Route::get('/edit_post/{id}',[PostController::class,'showEditScreen'])->name('editPost'); // View edit post
	Route::put('/edit_post/{post}',[PostController::class,'actuallyUpdatePost']); // Update post
	Route::get('/view_post/{id}',[PostController::class,'showViewScreen'])->name('viewPost'); // View post
	Route::get('/edit-image/{image}',[PostController::class,'showEditImage']); // Edit image Screen
	Route::delete('/delete-image/{image}',[PostController::class,'deleteImage']); // Delete image
	Route::post('/add-image/{id}',[PostController::class,'addImage']); // Add image, Id is user id from blade
	Route::put('/update-image/{image_id}',[PostController::class,'editImage'])->name('Image.update'); // Update image
	Route::post('/view_post/{id}',[PostController::class,'comment']); // Update comment
	Route::delete('/delete-post/{post}',[PostController::class,'deletePost']); // Delete post

	// Address routes
	Route::get('/user_address',[AddressController::class,'userAddress'])->name('userAddress'); // Get all country data
	Route::post('/fetch-city',[AddressController::class,'fetchCity']); // Ajax city
	Route::post('/fetch-district',[AddressController::class,'fetchDistrict']); // Ajax district
	Route::post('/save_address/{user_id}',[AddressController::class,'saveAddress']);
	Route::get('/new_country',[AddressController::class,'newCountry']);
	Route::get('/new_city/{country_id}',[AddressController::class,'newCity']);
	Route::get('/new_district/{city_id}',[AddressController::class,'newDistrict']);
	Route::post('/new_city/{country_id}',[AddressController::class,'saveNewCity']);
	Route::post('/new_district/{city_id}',[AddressController::class,'saveNewDistrict']);
	Route::post('/new_country',[AddressController::class,'saveNewCountry']);
	Route::get('/all_address',[AddressController::class,'allAddress'])->name('allAddress');
	// $url = route('editPost', ['id' => ...]);

});

