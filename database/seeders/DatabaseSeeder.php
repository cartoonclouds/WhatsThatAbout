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
        $this->call([
            UserSeeder::class,
            FormatSeeder::class,
            GenreSeeder::class,
            ThemeSeeder::class,
            ImageSeeder::class,
            PageSeeder::class,
            SegmentSeeder::class,
            ReferenceSeeder::class,
            VoteSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
