<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'attends', 'user_id', 'course_id')->withPivot(['gk', 'ck', 'is_dong_hoc']);
    }

    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'creator_id');
    }

    public function tasksReceived()
    {
        return $this->hasMany(Task::class, 'receiver_id');
    }

    public function messagesCreated()
    {
        return $this->hasMany(Message::class, 'user_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    function class ()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function consult()
    {
        return $this->hasMany(Classes::class, 'consultant_id', 'id');
    }
    public function soTc()
    {

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

    public static function averageMark($course)
    {
        return $course->pivot->gk * 0.4 + $course->pivot->ck * 0.6;
    }

    public static function roundNDigits($number, $n)
    {
        return $number;
    }
    public function getGPAAttribute()
    {
        $courses = $this->courses;
        $sumMark = 0;
        $sumCredit = 0;
        foreach ($courses as $course) {

            $mark = static::toFourMark(static::averageMark($course));
            $sumMark += $mark * $course->so_TC;
            $sumCredit += $course->so_TC;
        }
        if ($sumCredit === 0) {
            return 0;
        }

        return (float) $sumMark / $sumCredit;
    }

    public function getAccumulatedCreditsAttribute()
    {

        $courses = $this->courses;
        $accumulatedCredits = 0;
        foreach ($courses as $course) {
            $accumulatedCredits += $course->so_TC;
        }
        return $accumulatedCredits;
    }

    public function getSoTinNoAttribute()
    {
        $so_tin_no = 0;
        foreach ($this->courses as $course) {
            $mark = static::toFourMark(static::averageMark($course));
            if ($mark == 0) {
                $so_tin_no += $course->so_TC;
            }
        }
        return $so_tin_no;
    }
    public static function search($search)
    {

        $result = static::query();
        $result->where(function ($query) {
            $first = true;
            $query->where('role_id', 2)->whereIn('id', Auth::user()->consult->first()->member->where('role_id', 2)->pluck('id'));
            foreach (Auth::user()->consult as $class) {
                if ($first) {
                    $first = false;
                    continue;
                }
                $query->orWhereIn('id', $class->member->where('role_id', 2)->pluck('id'));
            }
        });

        if (!empty($search)) {

            $result->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('msv', 'like', '%' . $search . '%');
            });
        }
        return $result;
    }
}
