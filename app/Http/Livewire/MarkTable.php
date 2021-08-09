<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MarkTable extends Component
{
    use WithPagination;
    public $userId;
    public $term = 'all';
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'maMH';
    public $orderAsc = true;
    public function render()
    {
        $courses = User::find($this->userId)->courses();

        $search = $this->search;
        $courses->where(function ($query) use ($search) {
            $query->where('maMH', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        });
        if ($this->orderBy !== 'mark') {
            $courses->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');
        }
        if ($this->term != 'all') {
            $courses->where('term', (int) $this->term[0])->where('year', (int) substr($this->term, 1, 4));
        }
        return view('livewire.mark-table', [
            'courses' => $courses->paginate($this->perPage),
            'orderBy' => $this->orderBy,
            'orderAsc' => $this->orderAsc,
            'user' => User::find($this->userId),
        ]);
    }
}
