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
        return $this->belongsToMany(User::class, 'attends', 'course_id', 'user_id')->withPivot(['gk', 'ck', 'is_dong_hoc']);
    }

    public static function toCharMark($mark)
    {
        if ($mark < 4) {
            return 'F';
        } else if ($mark >= 4 && $mark < 5) {
            return 'D';
        } else if ($mark >= 5 && $mark < 5.5) {
            return 'D+';
        } else if ($mark >= 5.5 && $mark < 6.5) {
            return 'C';
        } else if ($mark >= 6.5 && $mark < 7) {
            return 'C+';
        } else if ($mark >= 7 && $mark < 8) {
            return 'B';
        } else if ($mark >= 8 && $mark < 8.5) {
            return 'B+';
        } else if ($mark >= 8.5 && $mark < 9) {
            return 'A';
        } else if ($mark >= 9) {
            return 'A+';
        } else {
            return 'N/A';
        }
    }

    public static function toFourMark($mark)
    {
        if ($mark < 4) {
            return 0;
        } else if ($mark >= 4 && $mark < 5) {
            return 1.0;
        } else if ($mark >= 5 && $mark < 5.5) {
            return 1.5;
        } else if ($mark >= 5.5 && $mark < 6.5) {
            return 2.0;
        } else if ($mark >= 6.5 && $mark < 7) {
            return 2.5;
        } else if ($mark >= 7 && $mark < 8) {
            return 3.0;
        } else if ($mark >= 8 && $mark < 8.5) {
            return 3.5;
        } else if ($mark >= 8.5 && $mark < 9) {
            return 3.7;
        } else if ($mark >= 9) {
            return 4.0;
        } else {
            return 'N/A';
        }

    }

    public function getAverageMarkAttribute()
    {
        return static::toFourMark($this->pivot->gk * 0.4 + $this->pivot->ck * 0.6);
    }

    public static function roundNDigits($number, $n)
    {
        return $number;
    }
}
