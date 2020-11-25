<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        activity()->withoutLogs(function () { // disable logging while seeding
            $this->call([
                UserSeeder::class,
                FormatSeeder::class,
                GenreSeeder::class,
                ThemeSeeder::class,
                ImageSeeder::class,
                PageSeeder::class,
                SceneSeeder::class,
                ReferenceSeeder::class,
                VoteSeeder::class,
                CommentSeeder::class,
            ]);
        });
    }
}
