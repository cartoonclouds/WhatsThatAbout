<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Show;
use Faker\Generator as Faker;

$factory->define(Show::class, function (Faker $faker) {
    return [
        'imdb_id' => 'tt' . $faker->numerify('#######'),
        'wikipedia_url' => $faker->url,
        'official_website_url' => $faker->url,
        'image_url' => $faker->imageUrl(),
        'running_length' => $faker->time,
        'is_draft' => $faker->boolean,
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});
