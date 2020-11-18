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
        Image::factory([
            'imageable_id' => 3
        ])->count(10)->for(
            Page::factory(), 'imageable'
        )->create();

        Image::factory()->count(10)->for(
            Segment::factory(), 'imageable'
        )->create();
    }
}
