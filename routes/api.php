<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});



// Posts 
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);

// Comments
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
});
