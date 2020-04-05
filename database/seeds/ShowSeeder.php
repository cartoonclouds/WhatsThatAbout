<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ShowSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(App\Models\Show::class, 20)
            ->create()
            ->each(function($show) {
                /** @var \App\Models\Show $show */

                $creator = $show->creator()->associate(
                    factory(\App\Models\User::class)->make()
                );

                $show->votes()->saveMany(
                    factory(\App\Models\Vote::class, 500)->make([
                        'votable_type' => get_class($show),
                        'votable_id' => $show->id
                    ])
                );

                $show->references()->saveMany(
                    factory(\App\Models\Reference::class, 100)->make([
                        'user_id' => $creator->id
                    ])
                );

                $show->ratings()->saveMany(
                    factory(\App\Models\Rating::class, 2)->make()
                );

                $show->genres()->saveMany(
                    factory(\App\Models\Genre::class, 2)->make()
                );


            });
    }
}
