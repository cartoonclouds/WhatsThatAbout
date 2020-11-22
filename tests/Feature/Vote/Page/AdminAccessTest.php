<?php

namespace Tests\Feature\Vote\Page;

use App\Models\Vote;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    // testAdminCan[not][method]Vote
    // testAdminCan[not][method]AnyVote

    // testBannedAdminCan[not][method]Vote
    // testBannedAdminCan[not][method]AnyVote

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

    public function testAdminCanCreateVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/pages/{$this->page->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedAdminCannotCreateVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/pages/{$this->page->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testAdminCanUpdateVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/votes/' . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Updating
    public function testBannedAdminCannotUpdateVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateAnyVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testAdminCanDestroyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCannotDestroyAnyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Destroying
    public function testBannedAdminCannotDestroyVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotDestroyAnyVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testAdminCanDeleteVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testAdminCannDeleteAnyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    // Banned User Deleting
    public function testBannedAdminCannotDeleteVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedAdminCannotDeleteAnyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }
}
