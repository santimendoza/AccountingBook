<?php

namespace App\Models;

use Auth;

class DateFunctions {

    public static function firstDayOfMonthString($month, $year) {
        $date = DateFunctions::firstDayOfMonth($month, $year);
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

    public static function lastDayOfMonthString($month, $year) {
        $date = DateFunctions::lastDayOfMonth($month, $year);
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

    public static function firstDayOfMonth($month, $year) {
        $date = date('Y-m-d', mktime(1, 1, 1, date($month), Auth::user()->courtdate, date($year)));
        return $date;
    }

    public static function lastDayOfMonth($month, $year) {
        $date = date('Y-m-d', mktime(1, 1, 1, date($month), Auth::user()->courtdate, date($year)));
        return $date;
    }

    public static function dateToString($date) {
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

}
