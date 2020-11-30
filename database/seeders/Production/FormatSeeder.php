<?php

namespace Database\Seeders\Production;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    protected static $formats = [
        [
            'name' => 'Movie',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Film',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'TV',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'TV Episode',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Video Game',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Anime',
            'definition' => '',
            'icon' => '',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::$formats as $format) {
            Format::factory()->create($format);
        }
    }
}
