<?php

namespace Tests\Feature\Comment\Segment;

use App\Models\Comment;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    // testAdminCan[not][method]Comment
    // testAdminCan[not][method]AnyComment
    // testAdminCan[not][method]CommentOutsideHour
    // testAdminCan[not][method]AnyCommentOutsideHour

    // testBannedAdminCan[not][method]Comment
    // testBannedAdminCan[not][method]AnyComment
    // testBannedAdminCan[not][method]CommentOutsideHour
    // testBannedAdminCan[not][method]AnyCommentOutsideHour

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

        $this->user->assignRole(User::ROLE_MOD);

        $this->bannedUser->assignRole(User::ROLE_MOD);
    }

    public function testAdminCanCreateComment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/segments/{$this->segment->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedAdminCannotCreateComment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/segments/{$this->segment->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testAdminCanUpdateComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/comments/' . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Updating
    public function testBannedAdminCannotUpdateComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateAnyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateAnyCommentOutsideHour()
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
    public function testAdminCanDestroyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCannotDestroyAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Destroying
    public function testBannedAdminCannotDestroyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotDestroyAnyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotDestroyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
  }

    public function testBannedAdminCannotDestroyAnyCommentOutsideHour()
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
    public function testAdminCanDeleteComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testAdminCannDeleteAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testAdminCanDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testAdminCanDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    // Banned User Deleting
    public function testBannedAdminCannotDeleteComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedAdminCannotDeleteAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedAdminCannotDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedAdminCannotDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }


    // User Restoring
    public function testAdminCanRestoreComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testAdminCanRestoreAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testAdminCanRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testAdminCanRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    // Banned User Restoring
    public function testBannedAdminCanRestoreComment()
    {
        $comment = Comment::factory()->create();

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedAdminCannotRestoreAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedAdminCannotRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedAdminCannotRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

}
