<?php


namespace App\Faker;

use Faker\Provider\Base;

class TimePeriodProvider extends Base
{
    public function timePeriod($hours = true, $minutes = true, $seconds = true, $milliseconds = false)
    {
        $str = '';

        if ($hours) {
            $str .= '##:';
        }

        if ($minutes) {
            $str .= '##:';
        }

        if ($seconds) {
            $str .= '##';
        }

        if ($milliseconds) {
            $str .= '.##';
        }

        return $this->generator->numerify($str);
    }
}
