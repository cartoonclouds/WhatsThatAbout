<?php


namespace App\Faker;

use Faker\Provider\Base;

class FilmThemeProvider extends Base
{
    protected static $types = [
        'Parody',
        'Self-Parody',
        '4th Wall',
        'Callback',
        'Satire',
        'Skit',
        'Mockery',
        'Imitation',
        'Irony',
    ];

    public function filmTheme()
    {
        return static::randomElement(static::$types);
    }
}
