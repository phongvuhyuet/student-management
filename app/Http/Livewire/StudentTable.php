<?php

namespace App\Http\Livewire;

use App\Models\Classes;
use Livewire\Component;
use Livewire\WithPagination;

class StudentTable extends Component
{
    use WithPagination;
    public $classId;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'msv';
    public $orderAsc = true;
    public function render()
    {
        $search = $this->search;
        $students = Classes::find($this->classId)->member()->where('role_id', 2)
            ->with('class:id,name,faculty');
        if (!empty($search)) {

            $students->where(function ($query) use ($search) {
                $query
                    ->where('email', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('msv', 'like', '%' . $search . '%');
            });
        }

        $students->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');
        return view('livewire.student-table', [
            'students' => $students->paginate($this->perPage, ['name', 'email', 'msv', 'date_of_birth', 'class_id']),
            'id' => $this->classId,
            'class' => Classes::find($this->classId, ['id', 'name']),
        ]);
        ddd([
            'students' => $students->paginate($this->perPage, ['name', 'email', 'msv', 'date_of_birth', 'class_id']),
            'id' => $this->classId,
            'class' => Classes::find($this->classId, ['id', 'name']),
        ]);
    }
}
