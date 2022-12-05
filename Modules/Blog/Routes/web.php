<?php

use Modules\Blog\Http\Controllers\BlogController;
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


Route::get('/blog' , [BlogController::class ,'index'])->name('blog');
Route::post('/blog/create/comment' , [BlogController::class ,'createcomment'])->name('comment.create');

