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
            $tasks = Task::search($this->search)->with('creator:id,name,msv')->where('receiver_id', Auth::user()->id)->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage, ['id', 'name', 'deadline', 'creator_id', 'receiver_id', 'progress', 'status', 'detail']);

        } else {
            $tasks = Task::search($this->search)->with('receiver:id,name,msv')->where('creator_id', Auth::user()->id)->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage, ['id', 'name', 'deadline', 'creator_id', 'receiver_id', 'progress', 'status', 'detail']);
        }
        return view('livewire.task-table', [
            'tasks' => $tasks,
        ]);
    }
}
