<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class VoteSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(App\Models\Vote::class, 500)
            ->create()
            ->each(function($vote) {
                /** @var \App\Models\Vote $vote */

                $vote->votables()->saveMany(
                    factory(App\Models\Show::class, 20)->make()
                );

                $vote->votables()->saveMany(
                    factory(App\Models\Reference::class, 20)->make()
                );

            });
    }
}
