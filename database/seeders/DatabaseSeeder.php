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
            ThemeSeeder::class,
            CommentSeeder::class,
            FormatSeeder::class,
            GenreSeeder::class,
            ImageSeeder::class,
            PageSeeder::class,
            ReferenceSeeder::class,
            SegmentSeeder::class,
            UserSeeder::class,
            VoteSeeder::class,
        ]);
    }
}
