<?php

namespace Tests\Feature\Page;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccess extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);
    }

    public function testGuestCannotCreatePage()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.pages.store'), Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdatePage()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->make([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyPage()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson(route('api.admin.pages.destroy', $page));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
