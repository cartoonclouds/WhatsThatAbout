<?php

namespace Tests\Unit;

use App\Models\Page;
use App\Models\Scene;
use App\Models\Vote;
use Tests\TestCase;

class VoteTest extends TestCase
{

    public function testVoteHasPage ()
    {
        $vote = Vote::factory()->for(
            Page::factory(),
            'votable'
        )->make();

        $this->assertTrue($vote->page->exists);
    }

    public function testVoteHasSegment ()
    {
        $vote = Vote::factory()->for(
            Scene::factory(),
            'votable'
        )->make();

        $this->assertTrue($vote->scene->exists);
    }

//    public function testVoteHasComment()
//    {
//        $vote = Vote::factory()->for(
//            Comment::factory(), 'votable'
//        )->make();
//
//        $this->assertTrue($vote->comment->exists);
//    }

    public function testVoteHasVoter ()
    {
        $vote = Vote::factory()->hasVoter()->make();

        $this->assertNotNull($vote->voter);
    }

//    public function testVoteHasReplies()
//    {
//
//    }
}
