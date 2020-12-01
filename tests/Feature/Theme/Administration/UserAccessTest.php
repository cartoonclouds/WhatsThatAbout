<?php

namespace Tests\Feature\Theme\Administration;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();
    }


    public function testUserCannotViewAllThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.index'));
    }


    public function testUserCannotViewCreateThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.themes.create'));
    }


    public function testUserCannotViewEditThemes ()
    {
        $this->expectException(AuthenticationException::class);

        $theme = Theme::factory()->create();

        $this->get(route('admin.themes.edit', $theme));
    }


    public function testUserCannotCreateTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.themes.store'), Theme::factory()->make()->toArray());
    }


    public function testUserCannotUpdateTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());
    }


    public function testUserCannotDestroyTheme ()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.themes.destroy', $theme));
    }


    public function testUserCannotDeleteTheme ()
    {
        $theme = Theme::factory()->create();

        $this->assertFalse($this->user->can('delete', $theme));
    }
}
