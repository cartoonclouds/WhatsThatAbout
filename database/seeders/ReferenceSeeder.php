<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Reference::factory()->count(10)->create();

        } catch (QueryException $e) {

        }
    }
}
