<?php

namespace Tests\Feature\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response = $this->post('/api/pages');

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotCreatePage()
    {
        $response = $this->actingAs($this->user)->post('/api/pages');

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdatePage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->put('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyPage()
    {
        $page = Page::factory()->create();

        $response = $this->actingAs($this->user)->delete('/api/pages/' . $page->getRouteKey());

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
