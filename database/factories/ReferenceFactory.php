<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reference;
use Faker\Generator as Faker;

$factory->define(Reference::class, function (Faker $faker) {
    return [
        'runs_throughout' => $faker->boolean,
        'start_time' => function($reference) use ($faker) {
            return $reference['runs_throughout'] ? null : $faker->time;
        },
        'finish_time' => function($reference) use ($faker) {
            return $reference['runs_throughout'] ? null : $faker->time;
        },
        'details' => $faker->paragraphs($faker->numberBetween(1, 4), true),
        'references' => [], //['imdb_id' => 'tt' . $faker->numerify('#######')],
        'show_id' => factory(\App\Models\Show::class)->create()->id,
        'user_id' => factory(\App\Models\User::class)->create()->id
    ];
});
