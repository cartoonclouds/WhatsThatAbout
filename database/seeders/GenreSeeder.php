<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Genre::factory()->count(10)->create();

        } catch (QueryException $e) {

        }
    }
}
