<?php

namespace Tests\Feature\Vote\Scene;

use App\Models\Vote;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    // testModeratorCan[not][method]Vote
    // testModeratorCan[not][method]AnyVote
    // testModeratorCan[not][method]VoteOutsideHour
    // testModeratorCan[not][method]AnyVoteOutsideHour

    // testBannedModeratorCan[not][method]Vote
    // testBannedModeratorCan[not][method]AnyVote
    // testBannedModeratorCan[not][method]VoteOutsideHour
    // testBannedModeratorCan[not][method]AnyVoteOutsideHour

    protected $user;
    protected $bannedUser;
    protected $scene;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'banned' => false
        ]);

        $this->bannedUser = User::factory()->banned()->create();

        $this->scene = Scene::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);

        $this->bannedUser->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCanCreateSceneVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedModeratorCannotCreateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testModeratorCanUpdateSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/votes/' . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateAnyVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Updating
    public function testBannedModeratorCannotUpdateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateVoteOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateAnyVoteOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testModeratorCanDestroySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCannotDestroyAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanDestroyVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanDestroyAnyVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Destroying
    public function testBannedModeratorCannotDestroySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyVoteOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyAnyVoteOutsideHour()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subMinute()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testModeratorCanDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testModeratorCannDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testModeratorCanDeleteVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testModeratorCanDeleteAnyVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    // Banned User Deleting
    public function testBannedModeratorCannotDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedModeratorCannotDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedModeratorCannotDeleteVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id,
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedModeratorCannotDeleteAnyVoteOutsideHour()
    {
        $vote = Vote::factory()->create([
            'user_id'    => User::factory()->create(),
            'created_at' => now()->subHours(2)
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }
}
