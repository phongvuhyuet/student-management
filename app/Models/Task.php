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
        $result = empty($search) ? static::query()
        : static::query()->where('id', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%');
        if (Gate::allows('manage-tasks')) {
            $result->orWhereHas('receiver', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->where('creator_id', Auth::user()->id);
        } else {
            $result->orWhereHas('creator', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->where('receiver_id', Auth::user()->id);
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
