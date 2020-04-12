<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vote;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {

    $votable = $faker->boolean ? factory(\App\Models\Show::class)->create() : factory(\App\Models\Reference::class)->create();

    return [
        'votable_type' => get_class($votable),
        'votable_id' => $votable->id,
        'user_id' => factory(\App\Models\User::class)->create()->id,
        'vote' => $faker->boolean ? $faker->numberBetween(1, 5) : null
    ];
});
