<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserSeederTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\User');
        factory(App\Models\User::class, 20)
            ->create()
            ->each(function ($user) {
                /** @var \App\Models\User $user */

                $user->shows()->saveMany(
                    factory(\App\Models\Show::class, 6)->make()
                );

                $user->references()->saveMany(
                    factory(\App\Models\Reference::class, 12)->make()
                );

            });
    }
}
