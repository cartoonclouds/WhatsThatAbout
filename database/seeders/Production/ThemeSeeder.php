<?php

namespace Database\Seeders\Production;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    protected static $themes = [
        [
            'name' => 'Parody',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Self-Parody',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => '4th Wall',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Callback',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Satire',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Skit',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Mockery',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Imitation',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Irony',
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
        foreach (static::$themes as $theme) {
            Theme::factory()->create($theme);
        }
    }
}
