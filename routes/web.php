<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



Route::get('/dashboard', function () {
    return response()->json([
        'message' => "You're logged in!",
        'posts' => \App\Models\Post::all()
    ]);
})->middleware(['auth', 'verified']);

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Posts  
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/', [PostController::class, 'index'])->name('home');

// Comments
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});



require __DIR__ . '/auth.php';
