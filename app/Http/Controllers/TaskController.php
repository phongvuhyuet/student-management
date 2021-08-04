<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:consultant', ['only' => ['create', 'store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks;
        if (Gate::denies('manage-tasks')) {
            $tasks = Task::where('receiver_id', Auth::user()->id);
        } else {
            $tasks = Task::where('creator_id', Auth::user()->id);
        }
        return view('task.index', ['tasks' => $tasks->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::where('role_id', 2)->where('class', Auth::user()->class)->where('faculty', Auth::user()->faculty)->get();
        $users = [];
        foreach (Auth::user()->consult as $class) {
            foreach ($class->member->where('role_id', 2) as $user) {
                array_push($users, $user);
            }
        }

        return view('task.create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required|date',
        ]);
        foreach ($request->assignees as $assignee) {
            Task::create([
                'name' => $request->name,
                'deadline' => $request->deadline,
                'detail' => $request->detail ?? null,
                'receiver_id' => $assignee,
                'creator_id' => Auth::user()->id,
                'progress' => 0,
                'status' => 'new',
            ]);
        }
        return redirect('task');
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
        $task = Task::find($id);
        return view('task.edit', [
            'task' => $task,
        ]);
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
        Task::find($id)->update($request->all());
        return redirect('/task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect('/task');
    }
}
