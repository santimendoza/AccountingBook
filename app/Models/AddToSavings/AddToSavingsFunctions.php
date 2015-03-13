<?php

namespace App\Models\AddToSavings;

use Illuminate\Database\Eloquent\Model;
use App\Models\Savings\Savings;
use App\Models\AddToSavings\AddToSavings;
use App\Models\DateFunctions;
use Auth;

class AddToSavingsFunctions {

    public static function getAddedSavings($id) {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $savings = AddToSavings::where('date', '>=', $monthstartdaystring)
                        ->where('user_id', '=', Auth::user()->id)
                        ->where('savings_id', '=', $id)->get();
        return $savings;
    }

    public static function calculateAddedSavingsValue($savings) {
        $total = 0.0;
        foreach ($savings as $saving) {
            $total += $saving->amount;
        }
        return $total;
    }

}
