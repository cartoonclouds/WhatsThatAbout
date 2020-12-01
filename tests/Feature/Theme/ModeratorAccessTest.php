<?php

namespace Tests\Feature\Theme;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }


    public function testModeratorCannotCreateTheme()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.themes.store'), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotUpdateTheme()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDestroyTheme()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.themes.destroy', $theme));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDeleteTheme()
    {
        $theme = Theme::factory()->create();

        $this->assertFalse($this->user->can('delete', $theme));
    }
}
