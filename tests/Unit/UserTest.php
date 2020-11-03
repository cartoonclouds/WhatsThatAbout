<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\Show;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
//    use RefreshDatabase;

    public function testUserHasShows()
    {
        $SEGMENT_COUNT = 6;

        $user = User::factory()->hasShows($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $user->shows);
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

        $show = Show::factory()->hasComments($COMMENT_COUNT, [
            'user_id' => $user->id
        ])->create([
            'user_id' => $user->id
        ]);

        $this->assertCount($COMMENT_COUNT, $show->comments);
        $this->assertCount($COMMENT_COUNT, $user->comments);
    }

//    public function testUserHasNotifications()
//    {
//
//    }
}
