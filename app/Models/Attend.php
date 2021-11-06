<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Attend extends Pivot
{

    protected $table = 'attends';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
