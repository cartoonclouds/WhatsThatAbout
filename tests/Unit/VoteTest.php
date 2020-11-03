<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Vote;
use App\Models\Segment;
use App\Models\Show;
use Tests\TestCase;

class VoteTest extends TestCase
{

    public function testVoteHasShow()
    {
        $vote = Vote::factory()->for(
            Show::factory(), 'votable'
        )->make();

        $this->assertTrue($vote->show->exists);
    }

    public function testVoteHasSegment()
    {
        $vote = Vote::factory()->for(
            Segment::factory(), 'votable'
        )->make();

        $this->assertTrue($vote->segment->exists);
    }

//    public function testVoteHasComment()
//    {
//        $vote = Vote::factory()->for(
//            Comment::factory(), 'votable'
//        )->make();
//
//        $this->assertTrue($vote->comment->exists);
//    }

    public function testVoteHasVoter()
    {
        $vote = Vote::factory()->hasVoter()->make();

        $this->assertNotNull($vote->voter);
    }

//    public function testVoteHasReplies()
//    {
//
//    }
}
