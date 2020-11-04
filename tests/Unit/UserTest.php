<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Page;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testUserHasPages()
    {
        $SEGMENT_COUNT = 6;

        $user = User::factory()->hasPages($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $user->pages);
    }

    public function testUserHasSegments()
    {
        $SEGMENT_COUNT = 6;

        $user = User::factory()->hasSegments($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $user->segments);
    }

    public function testUserHasComments()
    {
        $COMMENT_COUNT = 6;

        $user = User::factory()->create();

        $segment = Segment::factory()->hasComments($COMMENT_COUNT, [
            'user_id' => $user->id
        ])->create([
            'user_id' => $user->id
        ]);

        $this->assertCount($COMMENT_COUNT, $segment->comments);
        $this->assertCount($COMMENT_COUNT, $user->comments);
    }

//    public function testUserHasNotifications()
//    {
//
//    }
}
