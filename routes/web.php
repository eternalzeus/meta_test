<?php

use App\Models\Post;
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
Route::post('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);
Route::get('/register_page',function(){
    return view(view:'register_page');
});
Route::get('/login_page',function(){
    return view(view:'login_page');
});

// Blog post related routes

Route::group(['middleware' => ['check_login']], function () {
	Route::get('/', [UserController::class,'home'])->name('home'); // Home
	Route::get('/create-post',[PostController::class,'getPost'])->name('getPost'); // View create post
	Route::post('/create-post',[PostController::class,'createPost']);	// Create post
	Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']); // View edit post
	Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']); // Update post
	Route::get('/view-post/{post}',[PostController::class,'showViewScreen']); // View post
	Route::post('/view-post/{post}',[PostController::class,'comment']); // Update comment
	Route::delete('/delete-post/{post}',[PostController::class,'deletePost']); // Delete post
});

