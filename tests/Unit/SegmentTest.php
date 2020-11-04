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

    public function testSegmentHasCreator()
    {
        $segment = Segment::factory()->hasCreator()->make();

        $this->assertNotNull($segment->creator);
    }
}
