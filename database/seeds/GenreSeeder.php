<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class GenreSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(App\Models\Genre::class, 4)
            ->create()
            ->each(function($genre) {
                /** @var \App\Models\Genre $genre */

                $genre->shows()->saveMany(
                    factory(\App\Models\Show::class, 20)->make()
                );

            });
    }
}
