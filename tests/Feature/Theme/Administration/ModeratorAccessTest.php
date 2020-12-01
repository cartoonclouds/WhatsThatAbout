<?php

namespace Tests\Feature\Theme\Administration;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }


    public function testModeratorCannotViewAllThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.index'));
    }


    public function testModeratorCannotViewCreateThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.create'));
    }


    public function testModeratorCannotViewEditThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $this->get(route('admin.themes.edit', $theme));
    }


    public function testModeratorCannotCreateTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.themes.store'), Theme::factory()->make()->toArray());
    }


    public function testModeratorCannotUpdateTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());
    }


    public function testModeratorCannotDestroyTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.themes.destroy', $theme));
    }


    public function testModeratorCannotDeleteTheme ()
    {
        $theme = Theme::factory()->create();

        $this->assertFalse($this->user->can('delete', $theme));
    }
}
