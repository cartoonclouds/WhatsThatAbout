<?php

namespace Tests\Feature\Scene;

use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGuestCannotCreateScene()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson('/api/scenes/updateOrCreate', Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->postJson('/api/scenes/updateOrCreate/' . $scene->getRouteKey(), $scene->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->postJson('/api/scenes/updateOrCreate/' . $scene->getRouteKey(), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson('/api/scenes/' . $scene->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson('/api/scenes/' . $scene->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
