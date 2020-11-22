<?php

namespace Tests\Feature\Vote\Segment;

use App\Models\Vote;
use App\Models\Segment;
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

    public function testModeratorCanCreateVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/segments/{$this->segment->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedModeratorCannotCreateVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/segments/{$this->segment->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testModeratorCanUpdateVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/votes/' . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateAnyVote()
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
    public function testBannedModeratorCannotUpdateVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotUpdateAnyVote()
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
    public function testModeratorCanDestroyVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCannotDestroyAnyVote()
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
    public function testBannedModeratorCannotDestroyVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedModeratorCannotDestroyAnyVote()
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
    public function testModeratorCanDeleteVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testModeratorCannDeleteAnyVote()
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
    public function testBannedModeratorCannotDeleteVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedModeratorCannotDeleteAnyVote()
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
