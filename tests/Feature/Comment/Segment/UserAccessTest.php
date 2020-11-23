<?php

namespace Tests\Feature\Comment\Segment;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    // testUserCan[not][method]Comment
    // testUserCan[not][method]AnyComment
    // testUserCan[not][method]CommentOutsideHour
    // testUserCan[not][method]AnyCommentOutsideHour

    // testBannedUserCan[not][method]Comment
    // testBannedUserCan[not][method]AnyComment
    // testBannedUserCan[not][method]CommentOutsideHour
    // testBannedUserCan[not][method]AnyCommentOutsideHour

    protected $user;
    protected $bannedUser;
    protected $segment;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'banned' => false
        ]);

        $this->bannedUser = User::factory()->create([
            'banned' => true
        ]);

        $this->segment = Segment::factory()->create();
    }

    public function testUserCanCreateSegmentComment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/segments/{$this->segment->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedUserCannotCreateSegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/segments/{$this->segment->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testUserCanUpdateSegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotUpdateAnySegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateAnyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Updating
    public function testBannedUserCannotUpdateSegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotUpdateAnySegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotUpdateCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotUpdateAnyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testUserCanDestroySegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotDestroyAnySegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyAnyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Destroying
    public function testBannedUserCannotDestroySegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotDestroyAnySegmentComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotDestroyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotDestroyAnyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testUserCanDeleteSegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testUserCannotDeleteAnySegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $comment));
    }

    public function testUserCannotDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('delete', $comment));
    }

    public function testUserCannotDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('delete', $comment));
    }

    // Banned User Deleting
    public function testBannedUserCannotDeleteSegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedUserCannotDeleteAnySegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedUserCannotDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedUserCannotDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('delete', $comment));
    }


    // User Restoring
    public function testUserCannotRestoreSegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('restore', $comment));
    }

    public function testUserCannotRestoreAnySegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $comment));
    }

    public function testUserCannotRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('restore', $comment));
    }

    public function testUserCannotRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('restore', $comment));
    }

    // Banned User Restoring
    public function testBannedUserCanRestoreSegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedUserCannotRestoreAnySegmentComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedUserCannotRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedUserCannotRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->user->can('restore', $comment));
    }
}
