<?php

namespace App\Models;

use Auth;

class DateFunctions {

    public static function firstAndLastDayOfActualMonth() {
        if (date('d') > Auth::user()->courtdate) {
            $actualmonth = date('m') + 1;
        } else {
            $actualmonth = date('m');
        }

        $previousmonth = $actualmonth - 1;
        if (Auth::user()->courtdate > 28) {
            if (Auth::user()->courtdate > date('t', strtotime(date('Y-' . $previousmonth . '-d')))) {
                $firstDayOfMonth = date('Y-m-t', strtotime(date('Y-' . $previousmonth . '-d')));
            } else {
                $firstDayOfMonth = date('Y-m-d', strtotime(date('Y-' . $previousmonth . '-' . Auth::user()->courtdate)));
            }

            $day = date('d', strtotime($firstDayOfMonth));

            if ($day > date('d', strtotime(date('Y-m-t')))) {
                $lastDayOfMonth = date('Y-m-t', strtotime(date('Y-' . $actualmonth . '-t')));
            } else {
                $lastDayOfMonth = date('Y-m-d', strtotime(date('Y-' . $actualmonth . '-' . Auth::user()->courtdate)));
            }
        } else {
            $firstDayOfMonth = date('Y-m-d', strtotime(date('Y-' . $previousmonth . '-' . Auth::user()->courtdate)));
            $lastDayOfMonth = date('Y-m-d', strtotime(date('Y-' . $actualmonth . '-' . Auth::user()->courtdate)));
        }
        return [$firstDayOfMonth, $lastDayOfMonth];
    }

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
        $date = date('Y-m-t', mktime(1, 1, 1, date($month), Auth::user()->courtdate, date($year)));
        return $date;
    }

    public static function dateToString($date) {
        $datestring = str_replace('-', '', $date);
        return $datestring;
    }

}
