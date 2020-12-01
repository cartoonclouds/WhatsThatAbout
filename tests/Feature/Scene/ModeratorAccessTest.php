<?php

namespace Tests\Feature\Scene;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCanCreateSegment ()
    {
        $response = $this->actingAs($this->user)->post(route('admin.scenes.store'), Scene::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testModeratorCanUpdateSegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testModeratorCannotUpdateAnySegment ()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.scenes.store', $scene), Scene::factory()->make()->toArray());
    }

    public function testModeratorCanDestroySegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.scenes.destroy', $scene));

        $response->assertSuccessful();
    }

    public function testModeratorCannotDestroyAnySegment ()
    {
        $this->expectException(AuthorizationException::class);

        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.scenes.destroy', $scene));
    }


    public function testModeratorCanDeleteSegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->can('delete', $scene));
    }

    public function testModeratorCannotDeleteAnySegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertFalse($this->user->can('delete', $scene));
    }

    public function testModeratorCannotRestoreSegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertFalse($this->user->can('restore', $scene));
    }

    public function testModeratorCannotRestoreAnySegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertFalse($this->user->can('restore', $scene));
    }

    public function testModeratorCannotForceDeleteSegment ()
    {
        $scene = Scene::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertFalse($this->user->can('force-delete', $scene));
    }
}
