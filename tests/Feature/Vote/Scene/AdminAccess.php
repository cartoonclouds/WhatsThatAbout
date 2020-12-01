<?php

namespace Tests\Feature\Vote\Scene;

use App\Models\Vote;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccess extends TestCase
{
    // testAdminCan[not][method]Vote
    // testAdminCan[not][method]AnyVote

    // testBannedAdminCan[not][method]Vote
    // testBannedAdminCan[not][method]AnyVote

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

    public function testAdminCanCreateSceneVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedAdminCannotCreateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testAdminCanUpdateSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson('/api/votes/' . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Updating
    public function testBannedAdminCannotUpdateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotUpdateAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testAdminCanDestroySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCannotDestroyAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    // Banned User Destroying
    public function testBannedAdminCannotDestroySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedAdminCannotDestroyAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testAdminCanDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testAdminCannDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    // Banned User Deleting
    public function testBannedAdminCannotDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedAdminCannotDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }
}
