<?php

namespace App\Helper;

use Carbon\Carbon;

class TimeHelper
{
    /**
     * Return time left from now.
     *
     * @param time $time
     * @param boolean $inMinutes
     *
     * @return void
     */
    public static function GetTimeLeft($time, bool $inMinutes = false)
    {
        if(! isset($time))
            return null;

        if($inMinutes)
            return Carbon::now()->diffInMinutes($time);
        else
            return Carbon::now()->diffForHumans($time, true, true, 3);
    }
}
