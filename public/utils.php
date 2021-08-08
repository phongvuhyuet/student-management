<?php
function toCharMark($mark)
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

function toFourMark($mark)
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

function averageMark($course)
{
    return $course->pivot->gk * 0.4 + $course->pivot->ck * 0.6;
}

function roundNDigits($number, $n)
{
    return $number;
}
function calculateGPA($student)
{
    $courses = $student->courses;
    $sumMark = 0;
    $sumCredit = 0;
    foreach ($courses as $course) {

        $mark = toFourMark(averageMark($course));
        $sumMark += $mark * $course->so_TC;
        $sumCredit += $course->so_TC;
    }
    if ($sumCredit == 0) {
        return 0;
    } else {
        return number_format((float) $sumMark / $sumCredit, 2, '.', '');
    }

}

function getAccumulatedCredits($student)
{

    $courses = $student->courses;
    $accumulatedCredits = 0;
    foreach ($courses as $course) {
        $accumulatedCredits += $course->so_TC;
    }
    return $accumulatedCredits;
}

function getSoTinNo($student)
{
    $so_tin_no = 0;
    foreach ($student->courses as $course) {
        $mark = toFourMark(averageMark($course));
        if ($mark == 0) {
            $so_tin_no += $course->so_TC;
        }
    }
    return $so_tin_no;
}
