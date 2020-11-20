<?php

namespace Tests\Feature\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCannotCreatePage()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate', Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testModeratorCannotUpdatePage()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate/' . $page->getRouteKey(), Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testModeratorCannotDestroyPage()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testModeratorCannotDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $page));
    }

    public function testModeratorCannotRestorePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $page));
    }

    public function testModeratorCannotForceDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('force-delete', $page));
    }
}
