<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::apiResource('user', App\Http\Controllers\UserController::class);
Route::apiResource('task', App\Http\Controllers\TaskController::class);
Route::apiResource('course', App\Http\Controllers\CourseController::class);
Route::apiResource('message', App\Http\Controllers\MessageController::class);
Route::get('getAvatar', function () {
    return Storage::download(auth()->user()->profile_photo_path);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
