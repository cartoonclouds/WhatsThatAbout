<?php

namespace Tests\Feature\Scene;

use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testUserCannotCreateSegment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/scenes/updateOrCreate', Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateSegment()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/scenes/updateOrCreate/' . $scene->getRouteKey(), $scene->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/scenes/updateOrCreate/' . $scene->getRouteKey(), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroySegment()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/scenes/' . $scene->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/scenes/' . $scene->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDeleteSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $scene));
    }

    public function testUserCannotDeleteAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $scene));
    }

    public function testUserCannotRestoreSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $scene));
    }

    public function testUserCannotRestoreAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $scene));
    }

    public function testUserCannotForceDeleteSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('force-delete', $scene));
    }
}
