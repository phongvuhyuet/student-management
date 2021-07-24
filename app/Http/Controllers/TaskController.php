<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
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
            'progress' => 'required|numeric|min:0|max:100',
            'receiver_id' => 'required|numeric|exists:users,id',
            'creator_id' => 'required|numeric|exists:users,id',
            'parent_id' => 'exists:tasks,id'
        ]);
        // $rules = [
        //     'progress' => 'required|numeric|min:0|max:100',
        //     'receiver_id' => 'required|numeric|exists:users,id',
        //     'creator_id' => 'required|numeric|exists:users,id',
        //     'parent_id' => 'exists:tasks,id'
        // ];
        // $validator = Validator::make($request->all(), $rules);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        return Task::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
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
            'progress' => 'numeric|min:0|max:100',
            'receiver_id' => 'numeric|exists:users,id',
            'creator_id' => 'numeric|exists:users,id',
            'parent_id' => 'exists:tasks,id'
        ]);
        return Task::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Task::find($id)->delete();
    }
}
