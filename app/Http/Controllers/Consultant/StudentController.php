<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $class = Classes::find($id);
        if (!Gate::allows('manage-students', $class)) {
            abort(403);
        }
        $students = $class->member->where('role_id', 2);
        return view('consultant.students.index', ['students' => $students]);
    }

    public function classes()
    {
        $classes = Auth::user()->consult;
        return view('consultant.students.classes', ['classes' => $classes]);
    }

    public function getCourses($id)
    {

        return view('student.marks.index', ['id' => $id]);
    }
}
