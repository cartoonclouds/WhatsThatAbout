<?php

namespace Tests\Feature\Page;

use App\Models\Page;
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

    public function testGuestCannotCreatePage()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson('/api/pages/updateOrCreate', Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdatePage()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->postJson('/api/pages/updateOrCreate/' . $page->getRouteKey(), $page->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyPage()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson('/api/pages/' . $page->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
