<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/user/add', [UserController::class, 'add']);
Route::post('/user/remove/{id}', [UserController::class, 'remove']);
Route::get('/user/detail/{id}', [UserController::class, 'detail']);
Route::post('/user/edit/{id}', [UserController::class, 'edit']);
//Route::get('/user/list', [UserController::class, 'show']);
Route::get('/user/list', [UserController::class, 'show']);
