<?php

namespace Tests\Feature\Scene;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccess extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }

    public function testAdminCanCreateSegment()
    {
        $response = $this->actingAs($this->user)->post(route('admin.scenes.store'), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.scenes.destroy', $scene));

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.scenes.destroy', $scene));

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCanDeleteSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $scene));
    }

    public function testAdminCanDeleteAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $scene));
    }

    public function testAdminCanRestoreSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $scene));
    }

    public function testAdminCanRestoreAnySegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $scene));
    }

    public function testAdminCannotForceDeleteSegment()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('force-delete', $scene));
    }
}
