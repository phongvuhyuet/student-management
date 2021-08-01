<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Auth::user()->consult;
        $students = [];
        foreach ($classes as $class) {
            foreach ($class->member->where('role_id', 2) as $student) {
                array_push($students, $student);
            }
        }
        return view('consultant.students.index', ['students' => $students]);
    }
}
