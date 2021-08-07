<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TaskController;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $classes = Classes::with('member')->with('member.courses')->where('consultant_id', Auth::user()->id)->get();
    $tasks = Auth::user()->tasksCreated;
    return view('dashboard', [
        'classes' => $classes,
        'tasks' => $tasks,
    ]);
})->name('dashboard');
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function () {
    //     // Route::resource('marks', MarkController::class);
    // });
    Route::group(['middleware' => 'role:consultant', 'prefix' => 'consultant', 'as' => 'consultant.'], function () {
        Route::resource('students', StudentController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        // Route::resource('users', UserController::class);
    });
    Route::resource('task', TaskController::class);
    Route::resource('course', CourseController::class);
    Route::get('/marks/{id}', [StudentController::class, 'getCourses']);
    Route::group(['middleware' => 'role:consultant', 'as' => 'consultant.'], function () {
        Route::get('classes', [StudentController::class, 'classes']);
        Route::get('class/{id}/students', [StudentController::class, 'index']);
        Route::get('classes/test', [StudentController::class, 'test']);
        // Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('/view-grade', function () {

            return view('admin.view-grade');
        });
        Route::get('charts', function () {
            return view('consultant.charts.index');
        });
        Route::get('classChart', [ClassController::class, 'index']);
    });
});
