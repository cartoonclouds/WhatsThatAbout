<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Show;
use Tests\TestCase;

class CommentTest extends TestCase
{

    public function testCommentHasShow()
    {
        $comment = Comment::factory()->for(
            Show::factory(), 'commentable'
        )->make();

        $this->assertTrue($comment->show->exists);
    }

    public function testCommentHasSegment()
    {
        $comment = Comment::factory()->for(
            Segment::factory(), 'commentable'
        )->make();

        $this->assertTrue($comment->segment->exists);
    }

    public function testCommentHasCommenter()
    {
        $comment = Comment::factory()->hasCommenter()->make();

        $this->assertNotNull($comment->commenter);
    }

//    public function testCommentHasReplies()
//    {
//
//    }
}
