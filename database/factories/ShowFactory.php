<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Show;
use Faker\Generator as Faker;

$factory->define(Show::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug' => function($show) {
            return preg_replace('/[\W]/', '', $show['title']);
        },
        'synopsis' => $faker->paragraphs($faker->numberBetween(1, 10), true),
        'release_year' => $faker->numberBetween(1950, 2030), // '-30 years', '+5 years'
        'thumbnail' => $faker->imageUrl(),
        'runtime' => $faker->time,
        'references' => [],
        'is_published' => $faker->boolean,
        'rating_id' => factory(\App\Models\Rating::class)->create()->id,
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});
