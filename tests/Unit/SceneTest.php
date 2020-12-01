<?php

namespace Tests\Unit;

use App\Models\Scene;
use Tests\TestCase;

class SceneTest extends TestCase
{

    public function testSceneHasPage ()
    {
        $scene = Scene::factory()->forPage()->make();

        $this->assertNotNull($scene->page);
    }

    public function testSceneHasComments ()
    {
        $COMMENT_COUNT = 6;

        $scene = Scene::factory()->hasComments($COMMENT_COUNT)->create();

        $this->assertCount($COMMENT_COUNT, $scene->comments);
    }

    public function testSceneHasVotes ()
    {
        $VOTE_COUNT = 6;

        $scene = Scene::factory()->hasVotes($VOTE_COUNT)->create();

        $this->assertCount($VOTE_COUNT, $scene->votes);
    }

    public function testSceneHasCreator ()
    {
        $scene = Scene::factory()->hasCreator()->make();

        $this->assertNotNull($scene->creator);
    }

    public function testSceneHasGenre ()
    {
        $scene = Scene::factory()->forGenre()->make();

        $this->assertNotNull($scene->genre);
    }

    public function testSceneHasTheme ()
    {
        $scene = Scene::factory()->forTheme()->make();

        $this->assertNotNull($scene->theme);
    }
}
