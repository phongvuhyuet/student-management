<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ViewGradeTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'msv';
    public $orderAsc = true;
    public $class = 'all';
    public function render()
    {
        $students = User::search($this->search);
        if ($this->orderBy === 'msv' || $this->orderBy === 'name') {
            $students->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');
        }
        if ($this->class !== 'all') {
            $students->where('class_id', $this->class);
        }
        return view('livewire.view-grade-table', [
            'students' => $students->with(['courses:id,so_TC', 'class:id,name'])->paginate($this->perPage,
                ['id', 'msv', 'name', 'class_id', 'so_lan_nhac_nho']
            ),
            'orderBy' => $this->orderBy,
            'orderAsc' => $this->orderAsc,
            'classes' => Auth::user()->consult()->get(['id', 'name']),
        ]);
    }
}
