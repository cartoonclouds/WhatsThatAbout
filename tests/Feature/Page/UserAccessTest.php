<?php

namespace Tests\Feature\Page;

use App\Models\Page;
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

    public function testGuestCannotCreatePage()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate', Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotCreatePage()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate', Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdatePage()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create();

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate/' . $page->getRouteKey(), Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyPage()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDeletePage()
    {
        $page = Page::factory()->create();

        $this->assertFalse($this->user->can('delete', $page));
    }

    public function testUserCannotRestorePage()
    {
        $page = Page::factory()->create();

        $this->assertFalse($this->user->can('restore', $page));
    }

    public function testUserCannotForceDeletePage()
    {
        $page = Page::factory()->create();

        $this->assertFalse($this->user->can('force-delete', $page));
    }

}
