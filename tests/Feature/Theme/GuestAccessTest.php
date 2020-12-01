<?php

namespace Tests\Feature\Theme;

use App\Models\Theme;
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

    public function testGuestCannotCreateTheme()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.themes.store'), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateTheme()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $response = $this->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyTheme()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $response = $this->deleteJson(route('api.admin.themes.destroy', $theme));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
