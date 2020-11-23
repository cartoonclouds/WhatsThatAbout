<?php

namespace Tests\Unit;

use App\Models\Segment;
use Tests\TestCase;

class SegmentTest extends TestCase
{

    public function testSegmentHasPage()
    {
        $segment = Segment::factory()->forPage()->make();

        $this->assertNotNull($segment->page);
    }

    public function testSegmentHasComments()
    {
        $COMMENT_COUNT = 6;

        $segment = Segment::factory()->hasComments($COMMENT_COUNT)->create();

        $this->assertCount($COMMENT_COUNT, $segment->comments);
    }

    public function testSegmentHasVotes()
    {
        $VOTE_COUNT = 6;

        $segment = Segment::factory()->hasVotes($VOTE_COUNT)->create();

        $this->assertCount($VOTE_COUNT, $segment->votes);
    }

    public function testSegmentHasCreator()
    {
        $segment = Segment::factory()->hasCreator()->make();

        $this->assertNotNull($segment->creator);
    }

    public function testSegmentHasGenre()
    {
        $segment = Segment::factory()->forGenre()->make();

        $this->assertNotNull($segment->genre);
    }

    public function testSegmentHasTheme()
    {
        $segment = Segment::factory()->forTheme()->make();

        $this->assertNotNull($segment->theme);
    }
}
