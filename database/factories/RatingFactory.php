<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'country' => $faker->countryISOAlpha3,
        'rating' => $faker->randomElement(['G', 'PG', 'M', 'MA', 'R']),
        'description' => $faker->realText
    ];
});
