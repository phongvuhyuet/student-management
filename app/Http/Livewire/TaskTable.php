<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class TaskTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {
        $tasks;
        if (Gate::denies('manage-tasks')) {
            $tasks = Task::search($this->search)->where('receiver_id', Auth::user()->id)->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')->paginate($this->perPage);

        } else {
            $tasks = Task::search($this->search)->where('creator_id', Auth::user()->id)->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')->paginate($this->perPage);
        }
        return view('livewire.task-table', [
            'tasks' => $tasks,

        ]);
    }
}
