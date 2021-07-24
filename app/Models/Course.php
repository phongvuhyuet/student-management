<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'attends', 'course_id', 'user_id');
    }
}
