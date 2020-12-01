<?php

namespace Tests\Feature\Vote\Page;

use App\Models\Vote;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccess extends TestCase
{
    // testUserCan[not][method]Vote
    // testUserCan[not][method]AnyVote

    // testBannedUserCan[not][method]Vote
    // testBannedUserCan[not][method]AnyVote

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
    }

    public function testUserCanCreatePageVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/pages/{$this->page->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedUserCannotCreatePageVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/pages/{$this->page->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testUserCanUpdatePageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/votes/' . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotUpdateAnyPageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Updating
    public function testBannedUserCannotUpdatePageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotUpdateAnyPageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

            $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testUserCanDestroyPageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotDestroyAnyPageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Destroying
    public function testBannedUserCannotDestroyPageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotDestroyAnyPageVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testUserCanDeletePageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testUserCannotDeleteAnyPageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $vote));
    }

    // Banned User Deleting
    public function testBannedUserCannotDeletePageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedUserCannotDeleteAnyPageVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }
}
