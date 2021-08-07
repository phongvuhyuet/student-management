<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseTable extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'maMH';
    public $orderAsc = true;
    public function render()
    {
        $search = $this->search;
        $courses = Course::query();
        if (!empty($search)) {

            $courses->where(function ($query) use ($search) {
                $query
                    ->where('maMH', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%');
            });
        }

        $courses->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');
        return view('livewire.course-table', [
            'courses' => $courses->paginate($this->perPage),
        ]);
    }
}
