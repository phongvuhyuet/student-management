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
        $students = Classes::find($this->classId)->member()->where('role_id', 2);
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
            'students' => $students->paginate($this->perPage),
            'id'       => $this->classId,
            'class'    => Classes::find($this->classId),
        ]);
    }
}
