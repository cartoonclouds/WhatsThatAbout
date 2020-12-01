<?php

namespace Tests\Feature\Vote\Scene;

use App\Models\Vote;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    protected $scene;

    public function setUp(): void
    {
        parent::setUp();

        $this->scene = Scene::factory()->create();
    }

    public function testGuestCanCreateSceneVote()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/scenes/{$this->scene->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnySceneVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnySceneVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
