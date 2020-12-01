<?php

namespace Tests\Feature\Theme\Administration;

use App\Models\Theme;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    public function setUp ()
    : void
    {
        parent::setUp();

        $this->assertGuest();
    }


    public function testGuestCannotViewAllThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.index'));
    }


    public function testGuestCannotViewCreateThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.create'));
    }


    public function testGuestCannotViewEditThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $this->get(route('admin.themes.edit', $theme));
    }

    public function testGuestCannotCreateTheme ()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.themes.store'), Theme::factory()->make()->toArray());
    }

    public function testGuestCannotUpdateTheme ()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $response = $this->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());
    }

    public function testGuestCannotDestroyTheme ()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $response = $this->deleteJson(route('api.admin.themes.destroy', $theme));
    }
}
