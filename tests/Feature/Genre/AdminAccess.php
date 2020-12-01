<?php

namespace Tests\Feature\Genre;

use App\Models\User;
use App\Models\Genre;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccess extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }


    public function testAdminCanCreateGenre()
    {
        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCanUpdateGenre()
    {
        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCannotDestroyGenre()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testAdminCannotDeleteGenre()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
