<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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
        return view('consultant.students.index', ['id' => $id]);
    }

    public function classes()
    {
        $classes = Auth::user()->consult;
        return view('consultant.students.classes', ['classes' => $classes]);
    }

    public function getCourses($id)
    {
        if (Gate::denies('view-mark', $id)) {
            abort(403);
        };
        return view('student.marks.index', ['id' => $id]);
    }

    public function createStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'required|date',
            'msv' => 'required',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'msv' => $request->msv,
            'password' => Hash::make('password'),
            'class_id' => $id,
            'role_id' => 2,
        ]);
        $user->save();
        return redirect('/class/' . $id . '/students');
    }
}
