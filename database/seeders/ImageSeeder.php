<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Page;
use App\Models\Segment;
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
        Image::factory()->count(10)->create();
    }
}
