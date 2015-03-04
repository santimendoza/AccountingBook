<?php

namespace App\Models;

class DateFunctions {

    public static function firstDayOfMonth($month, $year) {
        $date = date('Y-m-d', mktime(1, 1, 1, date($month), 1, date($year)));
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

    public static function lastDayOfMonth($month, $year) {
        $date = date('Y-m-d', mktime(1, 1, 1, date($month) + 1, 0, date($year)));
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

}
