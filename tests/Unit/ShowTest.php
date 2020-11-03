<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowHasSegments()
    {
        $SEGMENT_COUNT = 6;

        $show = Show::factory()->hasSegments($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $show->segments);
    }

    public function testShowHasComments()
    {
        $COMMENT_COUNT = 6;

        $show = Show::factory()->hasComments($COMMENT_COUNT)->create();

        $this->assertCount($COMMENT_COUNT, $show->comments);
    }

    public function testShowHasCreator()
    {
        $show = Show::factory()->hasCreator()->make();

        $this->assertNotNull($show->creator);
    }
}
