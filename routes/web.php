<?php

use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
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
    return view('dashboard');
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
});

Route::get('/marks/{id}', [StudentController::class, 'getCourses']);
Route::group(['middleware' => 'role:consultant', 'as' => 'consultant.'], function () {
    Route::get('classes', [StudentController::class, 'classes']);
    Route::get('class/{id}/students', [StudentController::class, 'index']);
    Route::get('classes/test', [StudentController::class, 'test']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('/view-grade', function () {
        $students = User::where('role_id', 2)->whereIn('id', Auth::user()->consult->first()->member->where('role_id', 2)->pluck('id'));
        $first = true;
        foreach (Auth::user()->consult as $class) {
            if ($first) {
                $first = false;
                continue;
            }
            $students->orWhereIn('id', $class->member->where('role_id', 2)->pluck('id'));
        }
        return view('admin.view-grade', [
            'students' => $students->with('courses')->with('class')->get(),
        ]);
    });
});
