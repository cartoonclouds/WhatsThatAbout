<?php

namespace Tests\Feature\Theme\Administration;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }


    public function testAdminCanViewAllThemes ()
    {
        $this->actingAs($this->user)->get(route('admin.themes.index'))->assertSuccessful();
    }


    public function testAdminCanViewCreateThemes ()
    {
        $this->actingAs($this->user)->get(route('admin.themes.create'))->assertSuccessful();
    }


    public function testAdminCanViewEditThemes ()
    {
        $theme = Theme::factory()->create();

        $this->actingAs($this->user)->get(route('admin.themes.edit', $theme))->assertSuccessful();
    }


    public function testAdminCanCreateTheme ()
    {
        $response = $this->actingAs($this->user)->post(route('admin.themes.store'), Theme::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCanUpdateTheme ()
    {
        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCannotDestroyTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.themes.destroy', $theme));
    }


    public function testAdminCannotDeleteTheme ()
    {
        $theme = Theme::factory()->create();

        $this->assertFalse($this->user->can('delete', $theme));
    }
}
