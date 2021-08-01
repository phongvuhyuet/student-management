<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = 'classes';
    protected $guarded = [];

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id', 'id');
    }
    public function member()
    {
        return $this->hasMany(User::class, 'class_id', 'id');
    }
}
