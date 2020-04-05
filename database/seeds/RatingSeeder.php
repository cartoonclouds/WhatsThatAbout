<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RatingSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(App\Models\Rating::class, 4)
            ->create()
            ->each(function($rating) {
               /** @var \App\Models\Rating $rating */

                $rating->shows()->saveMany(
                    factory(\App\Models\Show::class, 20)->make()
                );

            });
    }
}
