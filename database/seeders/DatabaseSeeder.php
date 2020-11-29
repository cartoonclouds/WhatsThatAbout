<?php

namespace Database\Seeders;

use App\Models\User;
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
                PageSeeder::class,
                SceneSeeder::class,
                ReferenceSeeder::class,
                VoteSeeder::class,
                CommentSeeder::class,
            ]);

            User::find(1)->assignRole(User::ROLE_SUPER_ADMIN)->update([
                'email' => 'abbigail20@example.net'
            ]);
        });
    }
}
