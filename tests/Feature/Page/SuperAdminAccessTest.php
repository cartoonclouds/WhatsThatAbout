<?php

namespace Tests\Feature\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SuperAdminAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_SUPER_ADMIN);
    }

    public function testSuperAdminCanCreatePage()
    {
        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate', Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdatePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate/' . $page->getRouteKey(), $page->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdateAnyPage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/pages/updateOrCreate/' . $page->getRouteKey(), Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroyPage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroyAnyPage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testSuperAdminCanRestorePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testSuperAdminCanForceDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('force-delete', $page));
    }
}
