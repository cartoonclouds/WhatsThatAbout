<?php

namespace Tests\Feature\Theme;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Auth\Access\AuthorizationException;
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


    public function testAdminCanCreateTheme()
    {
        $response = $this->actingAs($this->user)->post(route('admin.themes.store'), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCanUpdateTheme()
    {
        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.themes.store', $theme), Theme::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCannotDestroyTheme()
    {
        $this->expectException(AuthorizationException::class);

        $theme = Theme::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.themes.destroy', $theme));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testAdminCannotDeleteTheme()
    {
        $theme = Theme::factory()->create();

        $this->assertFalse($this->user->can('delete', $theme));
    }
}
