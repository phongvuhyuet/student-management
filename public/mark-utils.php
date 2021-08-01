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

function roundNDigits($number, $n)
{
    return $number;
}
