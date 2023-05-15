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

Route::post('/create-post',[PostController::class,'createPost']); // Create post
Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']); // Edit screen
Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']); // Update post
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']); // Delete post
Route::get('/new_post',function(){
    return view(view:'new_post');
})->middleware(CheckLogin::class);

// View home page

Route::get('/', [UserController::class,'home'])->middleware(CheckLogin::class);