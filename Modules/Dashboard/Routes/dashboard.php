<?php

use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Dashboard\Http\Controllers\PostController;
use Modules\Dashboard\Http\Controllers\CommentController;
use Modules\Dashboard\Http\Middleware\redirectIfNotAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([redirectIfNotAdmin::class])->group(function () {
    Route::get('/admin', [DashboardController::class , 'index'])->name('admin');

    Route::get('/posts' , [PostController::class , 'index'])->name('posts');

    Route::get('/posts/create', [PostController::class , 'create'])->name('posts.create');
    Route::post('/post/store' , [PostController::class , 'store'])->name('post.store');

    Route::get('/post/edit/{id}' , [PostController::class , 'edit'])->name('post.edit');
    Route::post('/post/update/{id}' , [PostController::class , 'update'])->name('post.update');

    Route::get('/post/destroy' , [PostController::class , 'destroy'])->name('post.destroy');
    Route::get('/post/softDelete' , [PostController::class , 'softDelete'])->name('post.softDelete');
    Route::get('/post/rollBack' , [PostController::class , 'rollBack'])->name('post.rollBack');
});

