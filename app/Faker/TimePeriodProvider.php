<?php

namespace App\Faker;

use Faker\Provider\Base;

class TimePeriodProvider extends Base
{
    public function timePeriod($hours = true, $minutes = true, $seconds = true, $milliseconds = false)
    {
        $str = '';

        if ($hours) {
            $str .= sprintf("%02d", $this->generator->numberBetween(0, 23));
        }

        if ($minutes) {
            $str .= ':' . sprintf("%02d", $this->generator->numberBetween(0, 59));
        }

        if ($seconds) {
            $str .= ':' . sprintf("%02d", $this->generator->numberBetween(0, 59));
        }

        if ($milliseconds) {
            $str .= ':' . sprintf("%03d", $this->generator->numberBetween(0, 999));
        }



        return $this->generator->numerify($str);
    }
}
