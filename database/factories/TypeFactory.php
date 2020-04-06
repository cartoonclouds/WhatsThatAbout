<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    return [
        'term' => $faker->unique()->words($faker->numberBetween(1, 3), true),
        'definition' => $faker->sentence,
    ];
});
