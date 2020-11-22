<?php

namespace Tests\Feature\Comment\Page;

use App\Models\Comment;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    // testModeratorCan[not][method]Comment
    // testModeratorCan[not][method]AnyComment
    // testModeratorCan[not][method]CommentOutsideHour
    // testModeratorCan[not][method]AnyCommentOutsideHour

    // testBannedModeratorCan[not][method]Comment
    // testBannedModeratorCan[not][method]AnyComment
    // testBannedModeratorCan[not][method]CommentOutsideHour
    // testBannedModeratorCan[not][method]AnyCommentOutsideHour

    protected $user;
    protected $bannedUser;
    protected $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'banned' => false
        ]);

        $this->bannedUser = User::factory()->create([
            'banned' => true
        ]);

        $this->page = Page::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);

        $this->bannedUser->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCanCreateComment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/pages/{$this->page->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedModeratorCannotCreateComment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/pages/{$this->page->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testModeratorCanUpdateComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/comments/' . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Updating
    public function testBannedModeratorCannotUpdateComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateAnyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateAnyCommentOutsideHour()
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
    public function testModeratorCanDestroyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCannotDestroyAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanDestroyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanDestroyAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Destroying
    public function testBannedModeratorCannotDestroyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyAnyComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyCommentOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
  }

    public function testBannedModeratorCannotDestroyAnyCommentOutsideHour()
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
    public function testModeratorCanDeleteComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testModeratorCannDeleteAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testModeratorCanDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testModeratorCanDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    // Banned User Deleting
    public function testBannedModeratorCannotDeleteComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedModeratorCannotDeleteAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedModeratorCannotDeleteCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedModeratorCannotDeleteAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }


    // User Restoring
    public function testModeratorCanRestoreComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testModeratorCanRestoreAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testModeratorCanRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testModeratorCanRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    // Banned User Restoring
    public function testBannedModeratorCanRestoreComment()
    {
        $comment = Comment::factory()->create();

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedModeratorCannotRestoreAnyComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedModeratorCannotRestoreCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedModeratorCannotRestoreAnyCommentOutsideHour()
    {
        $comment = Comment::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

}
