<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // ddd(1);
        return view('admin.users.index', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|max:255|min:3',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8|max:255',
            'date_of_birth' => 'required|date',
            'role_id'       => 'required|numeric|min:1|max:3',
            'faculty'       => 'required',
            'class'         => 'required',
        ]);
        $user = new User($request->all());
        $user->password = Hash::make($user->password);
        return $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'          => 'max:255|min:3',
            'email'         => 'email|unique:users,email',
            'password'      => 'min:8|max:255',
            'date_of_birth' => 'date',
            'role_id'       => 'numeric|min:1|max:3',
        ]);

        return User::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCourses($id)
    {
        $courses = User::find($id)->courses;
        return view('student.marks.index', ['courses' => $courses]);
    }
}
