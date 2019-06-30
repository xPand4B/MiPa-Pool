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

    /**
     * Return timesteps.
     *
     * @param int  $steps
     * 
     * @return array
     */
    public static function GetTimesteps(int $steps = 15): ?array
    {
        if($steps <= 0)
            return null;

        $range = range(strtotime("00:00"), strtotime("24:00"), $steps * 60);
        $current = date("H:i");

        $timesteps = [];
        foreach($range as $step){
            $temp = date("H:i", $step);

            if($temp > $current)
                array_push($timesteps, $temp);
        }

        return $timesteps;
    }
}
