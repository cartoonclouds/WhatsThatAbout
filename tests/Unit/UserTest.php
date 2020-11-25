<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Scene;
use App\Models\Page;
use App\Models\User;
use App\Models\Vote;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function testUserHasPages()
    {
        $SEGMENT_COUNT = 6;

        $user = User::factory()->hasPages($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $user->pages);
    }

    public function testUserHasScenes()
    {
        $SEGMENT_COUNT = 6;

        $user = User::factory()->hasScenes($SEGMENT_COUNT)->create();

        $this->assertCount($SEGMENT_COUNT, $user->scenes);
    }

    public function testUserHasComments()
    {
        $COMMENT_COUNT = 6;

        $user = User::factory()->create();

        $scene = Scene::factory()->hasComments($COMMENT_COUNT, [
            'user_id' => $user->id
        ])->create([
            'user_id' => $user->id
        ]);

        $this->assertCount($COMMENT_COUNT, $scene->comments);
        $this->assertCount($COMMENT_COUNT, $user->comments);
    }


//    public function testUserHasNotifications()
//    {
//
//    }
}
