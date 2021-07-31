<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\Student\MarkController;
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
    Route::group(['middleware' => 'role:consultant', 'prefix' => 'consultant', 'as' => 'consultant.'], function () {
        Route::resource('students', StudentController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('users', UserController::class);
    });
});
