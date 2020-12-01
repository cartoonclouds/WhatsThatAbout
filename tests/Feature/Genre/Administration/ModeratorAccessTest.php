<?php

namespace Tests\Feature\Genre\Administration;

use App\Models\Genre;
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


    public function testModeratorCannotViewAllGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.index'));
    }


    public function testModeratorCannotViewCreateGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.create'));
    }


    public function testModeratorCannotViewEditGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $this->get(route('admin.genres.edit', $genre));
    }


    public function testModeratorCannotCreateGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());
    }


    public function testModeratorCannotUpdateGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());
    }


    public function testModeratorCannotDestroyGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));
    }


    public function testModeratorCannotDeleteGenre ()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
