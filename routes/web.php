<?php

<<<<<<< HEAD
use App\Http\Controllers\StudentController;
=======
use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\Student\MarkController;
>>>>>>> 1c0d95c4ecfb3a0f8efcd559c375adb26572f664
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

Route::redirect('/', 'login', 301);
Route::get('/view-grade', function () {
    return view('admin.view-grade');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function () {
        // Route::resource('marks', MarkController::class);
    });
<<<<<<< HEAD
    Route::group(['middleware' => 'role:consultant', 'prefix' => 'consultant', 'as' => 'consultant.'], function () {
        Route::resource('students', StudentController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        // Route::resource('users', UserController::class);
    });
    Route::resource('task', TaskController::class);
});

Route::get('/marks/{id}', [UserController::class, 'getCourses']);
=======
    Route::group(['middleware' => 'role:consultant', 'as' => 'consultant.'], function () {
        Route::get('classes', [StudentController::class, 'classes']);
        Route::get('class/{id}/students', [StudentController::class, 'index']);
        Route::get('classes/test', [StudentController::class, 'test']);

    });
    Route::resource('task', TaskController::class);
});
// Route::resource('users/test', UserController::class);
>>>>>>> 1c0d95c4ecfb3a0f8efcd559c375adb26572f664
