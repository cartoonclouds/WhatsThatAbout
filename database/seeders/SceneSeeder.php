<?php

namespace Database\Seeders;

use App\Models\Scene;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class SceneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Scene::factory()->count(10)->create();

        } catch (QueryException $e) {

        }
    }
}
