<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reference;
use Faker\Generator as Faker;

$factory->define(Reference::class, function (Faker $faker) {
    return [
        'throughout' => $faker->boolean,
        'start_time' => function($reference) use ($faker) {
            $reference['throughout'] ? null : $faker->time();
        },
        'finish_time' => function($reference) use ($faker) {
            $reference['throughout'] ? null : $faker->time();
        },
        'comment' => $faker->sentence($faker->numberBetween(6, 200)),
        'references' => '{}',
        'imdb_id' => 'tt' . $faker->numerify('#######'),
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});
