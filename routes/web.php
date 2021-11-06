<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\Consultant\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StatisticalController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WarnController;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::get('getAvatar', function () {
    return Storage::download(Auth::user()->profile_photo_path);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $classes = Classes::
        where('consultant_id', Auth::user()->id)->get(['id', 'name']);
    $tasks = Auth::user()->tasksCreated()->whereRaw('deadline - CAST(CURRENT_TIMESTAMP AS DATE) <= 7')->whereRaw('deadline - CAST(CURRENT_TIMESTAMP AS DATE) >= 0');
    $task_count = DB::select('call calTask(' . auth()->user()->id . ')');

    $students = DB::select('call calClasses(' . auth()->user()->id . ')');
    return view('dashboard', [
        'classes' => $classes,
        'tasks' => $tasks->with('creator:id,name,msv')->with('receiver:id,name,msv')->get(['status', 'receiver_id', 'creator_id', 'id', 'deadline', 'name', 'progress']),
        'students' => collect($students),
        'task_count' => collect($task_count),
    ]);

})->name('dashboard');
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::view('/chat', 'chat.index');
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
        Route::get('class/{id}/create', function ($id) {
            if (Gate::denies('manage-students', Classes::find($id))) {
                abort(403);
            }
            return view('statistical.student-form', [
                'id' => $id,
            ]);
        });
        Route::post('class/{id}/create', [StudentController::class, 'createStudent']);
        Route::resource('course', CourseController::class);
        Route::get('/statistical', [StatisticalController::class, 'index']);
        Route::get('classChart', [ClassController::class, 'index']);
        Route::get('/warn_hoc_phi', [WarnController::class, 'warnHocPhiAll']);
        Route::get('/warn_hoc_phi/{id}', [WarnController::class, 'warnHocPhi']);
        Route::get('/warn_nghi_hoc', [WarnController::class, 'warnNghiHocAll']);
        Route::get('/warn_nghi_hoc/{id}', [WarnController::class, 'warnNghiHoc']);
    });
});
