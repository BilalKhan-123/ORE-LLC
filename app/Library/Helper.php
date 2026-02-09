<?php

namespace App\Library;

use Carbon\Carbon;

class Helper
{
    public static function getModelNameFromClassName($class)
    {
        return last(explode('\\', ($class)));
    }

    public static function generatePassword($length = 8)
    {
        $charPools = [
            'uppercase' => range('A', 'Z'),
            'lowercase' => range('a', 'z'),
            'numbers' => range(0, 9),
            'special' => str_split('@$'),
        ];

        // Guarantee at least one uppercase and special character
        $password = $charPools['uppercase'][array_rand($charPools['uppercase'])] . $charPools['special'][array_rand($charPools['special'])];

        // Fill remaining characters with random choices from all pools
        while (strlen($password) < $length) {
            $pool = array_rand($charPools);
            $password .= $charPools[$pool][array_rand($charPools[$pool])];
        }

        return str_shuffle($password);
    }

    public static function epochToDate(int $epochTime, string $timeFormat)
    {
        return Carbon::parse($epochTime)->format($timeFormat);
    }

    public static function generateClientCode()
    {
        $clientCode = rand(100000, 999999);

        return $clientCode;
    }
}
