<?php

namespace Tests\Feature\Scene;

use App\Http\Middleware\VerifyAdmin;
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

        $this->withoutMiddleware(VerifyAdmin::class);
    }

    public function testGuestCannotCreateScene()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.scenes.store'), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson(route('api.admin.scenes.destroy', $scene));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnyScene()
    {
        $this->expectException(AuthenticationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson(route('api.admin.scenes.destroy', $scene));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
