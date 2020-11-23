<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Page;
use App\Models\Segment;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Image::factory()->count(10)->create();

        } catch (QueryException $e) {

        }
    }
}
