<?php

namespace App\Providers;

use App\Faker\Base64ImageProvider;
use App\Faker\FilmGenreProvider;
use App\Faker\FilmThemeProvider;
use App\Faker\MediaFormatProvider;
use App\Faker\TimePeriodProvider;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function($app) {
            $faker = \Faker\Factory::create();

            $faker->addProvider(new TimePeriodProvider($faker));
            $faker->addProvider(new FilmGenreProvider($faker));
            $faker->addProvider(new FilmThemeProvider($faker));
            $faker->addProvider(new MediaFormatProvider($faker));
            $faker->addProvider(new Base64ImageProvider($faker));

            return $faker;
        });


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
