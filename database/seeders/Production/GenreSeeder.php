<?php

namespace Database\Seeders\Production;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    protected static $genres = [
        [
            'name' => 'Action',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Adventure',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Animation',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Anime',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Biography',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Comedy',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Crime',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Documentary',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Drama',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Family',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Fantasy',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Film-Noir',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Game Show',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'History',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Horror',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Live-Action',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Musical',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Mystery',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'News',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Philosophical',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Political',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Reality-TV',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Romance',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Sci-Fi',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Short Film',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Sport',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Superhero',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Talk Show',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Thriller',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'War',
            'definition' => '',
            'icon' => '',
        ],
        [
            'name' => 'Western',
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
        foreach (static::$genres as $genre) {
            Genre::factory()->create($genre);
        }
    }
}
