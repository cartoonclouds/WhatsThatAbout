<?php

namespace Tests\Feature\Genre;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccess extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }


    public function testModeratorCannotCreateGenre()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotUpdateGenre()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDestroyGenre()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDeleteGenre()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
