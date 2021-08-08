<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function toCharMark($mark)
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

    public function toFourMark($mark)
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

    public function averageMark($course)
    {
        return $course->pivot->gk * 0.4 + $course->pivot->ck * 0.6;
    }

    public function roundNDigits($number, $n)
    {
        return $number;
    }
    public function calculateGPA($student)
    {
        $courses = $student->courses;
        $sumMark = 0;
        $sumCredit = 0;
        foreach ($courses as $course) {

            $mark = $this->toFourMark($this->averageMark($course));
            $sumMark += $mark * $course->so_TC;
            $sumCredit += $course->so_TC;
        }
        if ($sumCredit == 0) {
            return 0;
        } else {
            return number_format((float) $sumMark / $sumCredit, 2, '.', '');
        }

    }

    public function index()
    {
        $data = [];
        $classes = Auth::user()->consult;
        foreach ($classes as $class) {
            $countXs = 0;
            $countG = 0;
            $countK = 0;
            $countTb = 0;
            $countY = 0;
            foreach ($class->member->where('role_id', 2) as $student) {
                $gpa = $this->calculateGPA($student);
                if ($gpa >= 3.6) {
                    $countXs++;
                } elseif ($gpa >= 3.2) {
                    $countG++;
                } elseif ($gpa >= 2.5) {
                    $countK++;
                } elseif ($gpa >= 2.0) {
                    $countTb++;
                } else {
                    $countY++;
                }

            }
            $data[$class->name] = [
                'countY' => $countY,
                'countTb' => $countTb,
                'countK' => $countK,
                'countG' => $countG,
                'countXs' => $countXs,

            ];
        }

        return $data;
    }
}
