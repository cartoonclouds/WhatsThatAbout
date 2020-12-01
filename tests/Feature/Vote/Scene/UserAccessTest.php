<?php

namespace Tests\Feature\Vote\Scene;

use App\Models\Vote;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    // testUserCan[not][method]Vote
    // testUserCan[not][method]AnyVote

    // testBannedUserCan[not][method]Vote
    // testBannedUserCan[not][method]AnyVote

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
    }

    public function testUserCanCreateSceneVote()
    {
        $response = $this->actingAs($this->user, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testBannedUserCannotCreateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->bannedUser, 'api')->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Updating
    public function testUserCanUpdateSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotUpdateAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Updating
    public function testBannedUserCannotUpdateSceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotUpdateAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Destroying
    public function testUserCanDestroySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testUserCannotDestroyAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // Banned User Destroying
    public function testBannedUserCannotDestroySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testBannedUserCannotDestroyAnySceneVote()
    {
        $this->expectException(AuthorizationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->bannedUser, 'api')->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    // User Deleting
    public function testUserCanDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $vote));
    }

    public function testUserCannotDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $vote));
    }

    // Banned User Deleting
    public function testBannedUserCannotDeleteSceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => $this->bannedUser->id
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }

    public function testBannedUserCannotDeleteAnySceneVote()
    {
        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->bannedUser->can('delete', $vote));
    }
}
