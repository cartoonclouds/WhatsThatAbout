<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ReferenceSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(App\Models\Reference::class, 20)
            ->create()
            ->each(function($reference) {
                /** @var \App\Models\Reference $reference */

                $reference->types()->saveMany(
                    factory(\App\Models\Type::class, 2)->make()
                );

                $reference->show()->save(
                    factory(\App\Models\Show::class)->make()
                );

                $reference->creator()->save(
                    factory(\App\Models\User::class)->make()
                );

            });
    }
}
