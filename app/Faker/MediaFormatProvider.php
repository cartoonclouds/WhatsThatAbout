<?php


namespace App\Faker;

use Faker\Provider\Base;

class MediaFormatProvider extends Base
{
    protected static $formats = [
        'Movie',
        'Film',
        'TV',
        'TV Episode',
        'Video Game',
        'Anime',
    ];

    public function mediaFormat()
    {
        return static::randomElement(static::$formats);
    }
}
