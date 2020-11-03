<?php

namespace Tests\Feature\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }

    public function testAdminCanCreatePage()
    {
        $response = $this->actingAs($this->user)->post('/pages');

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdatePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->put('/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnyPage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->put('/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyPage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->delete('/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyAnyPage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->delete('/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCanDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testAdminCanDeleteAnyPage()
    {
        $page = Page::factory()->create();

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testAdminCanRestorePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testAdminCanRestoreAnyPage()
    {
        $page = Page::factory()->create();

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testAdminCannotForceDeletePage()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('force-delete', $page));
    }
}
