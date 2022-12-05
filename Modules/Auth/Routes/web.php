<?php

use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\RegisterController;
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

Route::get('/login' , [AuthController::class , 'index'])->name('loginView');
Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');
Route::post('/credential/validate' , [AuthController::class , 'credentialValidate'])->name('credentialValidate');


Route::get('/register' , [RegisterController::class , 'index'])->name('registerView');
Route::post('/register' , [RegisterController::class , 'store'])->name('register');
