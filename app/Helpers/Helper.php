<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
    public static function generateOTP($length)
    {
        $otp = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);

        return $otp;
    }

    public static function getCurrentAge(string $date)
    {
        $birthDate = Carbon::parse($date);
        $currentDate = Carbon::now();

        return $birthDate->diffInYears($currentDate);
    }

    public static function getAgeGroupPercentile(array $valueArr, int|float $value)
    {
        array_push($valueArr, $value);
        $valueArr = array_unique($valueArr);
        sort($valueArr);
        $index = array_search($value, $valueArr);

        if ($index === false) {
            return 0;
        }

        $count = count($valueArr);
        $divVal = ($count - 1);
        if ($divVal == 0) {
            $percentile = 100;
        } else {
            $percentile = ($index / ($count - 1)) * 100;
        }

        return round($percentile, 2);
    }
}
