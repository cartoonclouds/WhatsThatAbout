<?php

namespace Tests\Feature\Comment\Page;

use App\Models\Comment;
use App\Models\Page;
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
    protected $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'banned' => false
        ]);

        $this->bannedUser = User::factory()->banned()->create();

        $this->page = Page::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);

        $this->bannedUser->assignRole(User::ROLE_MOD);
    }

    public function testAdminCanCreatePageComment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/pages/{$this->page->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedAdminCannotCreatePageComment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/pages/{$this->page->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testAdminCanUpdatePageComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/comments/' . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnyPageComment()
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
    public function testBannedAdminCannotUpdatePageComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateAnyPageComment()
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
    public function testAdminCanDestroyPageComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCannotDestroyAnyPageComment()
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
    public function testBannedAdminCannotDestroyPageComment()
    {
        $this->expectException(AuthorizationException::class);

        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotDestroyAnyPageComment()
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
    public function testAdminCanDeletePageComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $comment));
    }

    public function testAdminCannDeleteAnyPageComment()
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
    public function testBannedAdminCannotDeletePageComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $comment));
    }

    public function testBannedAdminCannotDeleteAnyPageComment()
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
    public function testAdminCanRestorePageComment()
    {
        $comment = Comment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $comment));
    }

    public function testAdminCanRestoreAnyPageComment()
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
    public function testBannedAdminCanRestorePageComment()
    {
        $comment = Comment::factory()->create();

        $this->assertFalse($this->bannedUser->can('restore', $comment));
    }

    public function testBannedAdminCannotRestoreAnyPageComment()
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
