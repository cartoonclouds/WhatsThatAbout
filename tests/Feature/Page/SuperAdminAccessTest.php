<?php

namespace Tests\Feature\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->actingAs($this->user)->post('/api/pages');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdatePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->put('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdateAnyPage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->put('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroyPage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->delete('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroyAnyPage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->delete('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDeletePagew()
    {
        $page = Page::factory()->create();

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testSuperAdminCanRestorePage()
    {
        $page = Page::factory()->create();

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testSuperAdminCanForceDeletePage()
    {
        $page = Page::factory()->create();

        $this->assertTrue($this->user->can('force-delete', $page));
    }
}
