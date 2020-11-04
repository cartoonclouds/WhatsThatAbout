<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Page;
use App\Models\User;
use Tests\TestCase;

class PageTest extends TestCase
{

    public function testPageHasSegments()
    {
        $SEGMENT_COUNT = 6;

        $page = Page::factory()->hasSegments($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $page->segments);
    }

    public function testPageHasComments()
    {
        $COMMENT_COUNT = 6;

        $page = Page::factory()->hasComments($COMMENT_COUNT)->create();

        $this->assertCount($COMMENT_COUNT, $page->comments);
    }

    public function testPageHasCreator()
    {
        $page = Page::factory()->hasCreator()->make();

        $this->assertNotNull($page->creator);
    }
}
