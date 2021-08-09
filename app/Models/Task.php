<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search($search)
    {
        $result = static::query();
        if (Gate::allows('manage-tasks')) {
            $result->where('creator_id', Auth::user()->id);
        } else {
            $result->where('receiver_id', Auth::user()->id);
        }
        if (!empty($search)) {
            $result->where(function ($query) use ($search) {
                $query->where('id', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%');
                if (Gate::allows('manage-tasks')) {
                    $query->orWhereHas('receiver', function (Builder $query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                } else {
                    $query->orWhereHas('creator', function (Builder $query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                }
            });
        }
        return $result;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
