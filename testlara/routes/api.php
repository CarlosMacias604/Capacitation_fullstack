<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
});


Route::resource('category', CategoryController::class)->middleware('auth:api');;
Route::resource('post', PostController::class)->middleware('auth:api');;


//Upload image
Route::post('post/upload/{post}', [PostController::class, 'upload']);
//Get post by slug
Route::get('post/slug/{slug}', [PostController::class, 'slug']);

//Get category by slug
Route::get('category/slug/{slug}', [CategoryController::class, 'slug']);

//Get posts by category
Route::get('category/{category}/posts', [CategoryController::class, 'posts']);

//Users
//Route::post('user/login', [UserController::class, 'login']);

Route::get('user', [AuthController::class, 'user'])->middleware('auth:api');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');