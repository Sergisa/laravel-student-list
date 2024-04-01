<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class, 'show']);
Route::get('/logs', [LogController::class, 'show']);
Route::get('/logs', [LogController::class, 'show2']);
Route::get('/user/list', [UserController::class, 'show']);
Route::get('/user/add', [LogController::class, 'show2']);
