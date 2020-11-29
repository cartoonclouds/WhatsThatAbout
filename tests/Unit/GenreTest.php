<?php

namespace Tests\Unit;

use App\Models\Genre;
use Tests\TestCase;

class GenreTest extends TestCase
{

    public function testGenreHasScenes()
    {
        $SCENE_COUNT = 6;

        $genre = Genre::factory()->hasScenes($SCENE_COUNT)->create();

        $this->assertCount($SCENE_COUNT, $genre->scenes);
    }

    public function testGenreHasPages()
    {
        $PAGE_COUNT = 6;

        $genre = Genre::factory()->hasPages($PAGE_COUNT)->create();

        $this->assertCount($PAGE_COUNT, $genre->pages);
    }
}
