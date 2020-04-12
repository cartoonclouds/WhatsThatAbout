<?php

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
        $this->call(TypeSeederTableSeeder::class);
        $this->call(UserSeederTableSeeder::class);
        $this->call(ShowSeederTableSeeder::class);
    }
}
