<?php

namespace Tests\Unit;

use App\Models\Page;
use Tests\TestCase;

class PageTest extends TestCase
{

    public function testPageHasScenes ()
    {
        $SEGMENT_COUNT = 6;

        $page = Page::factory()->hasScenes($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $page->scenes);
    }

    public function testPageHasComments ()
    {
        $COMMENT_COUNT = 6;

        $page = Page::factory()->hasComments($COMMENT_COUNT)->create();

        $this->assertCount($COMMENT_COUNT, $page->comments);
    }

    public function testPageHasVotes ()
    {
        $VOTE_COUNT = 6;

        $page = Page::factory()->hasVotes($VOTE_COUNT)->create();

        $this->assertCount($VOTE_COUNT, $page->votes);
    }

    public function testPageHasCreator ()
    {
        $page = Page::factory()->hasCreator()->make();

        $this->assertNotNull($page->creator);
    }


    public function testPageHasGenre ()
    {
        $scene = Page::factory()->forGenre()->make();

        $this->assertNotNull($scene->genre);
    }

    public function testPageHasFormat ()
    {
        $scene = Page::factory()->forFormat()->make();

        $this->assertNotNull($scene->format);
    }
}
