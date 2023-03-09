<?php

namespace App\Support\Traits;

use Carbon\Carbon;

trait HelperTrait
{
    /**
     * @param $uid
     * @return int
     */
    public static function cleanupUid($uid): int // Cleanup User ID
    {
        return !(is_numeric($uid)) ? self::generateRandID() : $uid;
    }

    /**
     * @param int $digits
     * @return int
     */
    public static function generateRandID(int $digits = 9): int
    {
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
    }

    public static function cleanupDateString(string $date): string
    {
        $date = preg_replace('/[a-zA-Z]/', '', $date);
        return Carbon::parse($date)->toDateString();
    }
}
