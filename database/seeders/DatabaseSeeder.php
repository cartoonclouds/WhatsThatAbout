<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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

            if (App::isProduction()) {

                $this->call([
                    \Database\Seeders\Production\UserSeeder::class,
                    \Database\Seeders\Production\FormatSeeder::class,
                    \Database\Seeders\Production\GenreSeeder::class,
                    \Database\Seeders\Production\ThemeSeeder::class,
                ]);

            } else {

                User::factory([
                    'name'     => 'Test Super Admin',
                    'username' => 'super-admin@example.com',
                    'banned'   => false
                ])->assignRole(User::ROLE_SUPER_ADMIN);

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

            }

        });
    }
}
