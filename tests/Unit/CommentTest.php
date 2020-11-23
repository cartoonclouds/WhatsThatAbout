<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Page;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testCommentHasPage()
    {
        $comment = Comment::factory()->for(
            Page::factory(),
            'commentable'
        )->make();

        $this->assertTrue($comment->page->exists);
    }

    public function testCommentHasSegment()
    {
        $comment = Comment::factory()->for(
            Segment::factory(),
            'commentable'
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
//        $comment = Comment::factory()->for(
//            Comment::factory(), 'commentable'
//        )->make();
//
//        $this->assertTrue($comment->replies->exists);
//    }
}
