<?php

use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Student\MarkController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function () {
        Route::resource('marks', MarkController::class);
    });
    Route::group(['middleware' => 'role:consultant', 'as' => 'consultant.'], function () {
        Route::get('classes', [StudentController::class, 'classes']);
        Route::get('class/{id}/students', [StudentController::class, 'index']);
        Route::get('classes/test', [StudentController::class, 'test']);

    });
    Route::resource('task', TaskController::class);
    Route::resource('course', CourseController::class);
});
// Route::resource('users/test', UserController::class);
