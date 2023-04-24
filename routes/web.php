<?php

use Illuminate\Support\Facades\Route;

// Auth
Route::controller(App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('giris-yap', function () {return view('auth.login');})->name('auth.login');
    Route::get('kayit-ol', function () {return view('auth.register');})->name('auth.register');

    Route::POST('register', 'register')->name('register')->middleware('throttle:auth');
    Route::POST('login', 'login')->name('login')->middleware('throttle:auth'); 
    Route::POST('logout', 'logout')->name('logout');
});

// Admin
Route::prefix('admin')->middleware('auth', 'isAdmin')->name('admin.')->group(function () {
    Route::controller(App\Http\Controllers\Back\IndexController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    Route::controller(App\Http\Controllers\Back\PostController::class)->group(function () {
        Route::get('posts', 'index')->name('posts');
        Route::get('posts/create', 'create')->name('posts.create');
        Route::get('posts/edit/{post}', 'edit')->name('posts.edit');

        Route::POST('posts/store', 'store')->name('posts.store');
        Route::PUT('posts/update', 'update')->name('posts.update');
        Route::DELETE('posts/destroy', 'destroy')->name('posts.destroy');
    });
    Route::controller(App\Http\Controllers\Back\CommentController::class)->group(function () {
        Route::get('comments', 'index')->name('comments');
        Route::DELETE('comments/destroy', 'destroy')->name('comments.destroy');
    });
});

// Front
Route::controller(App\Http\Controllers\Front\PostController::class)->middleware('auth')->group(function () {
    Route::get('blog/{slug}', 'show')->name('posts.show');
    Route::get('posts/create', 'create')->name('posts.create');

    Route::POST('posts/store', 'store')->name('posts.store');
    Route::POST('posts/comment', 'comment')->name('posts.comment');
    Route::POST('posts/like', 'like')->name('posts.like');
});
Route::controller(App\Http\Controllers\Front\IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});
