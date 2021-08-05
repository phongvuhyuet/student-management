<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $classes = Auth::user()->consult;
        $classes = Classes::with('member')->with('member.courses')->where('consultant_id', Auth::user()->id)->get();
        $tasks = Auth::user()->tasksCreated;
        return view('dashboard', [
            'classes' => $classes,
            'tasks'   => $tasks,
        ]);
    }
}
