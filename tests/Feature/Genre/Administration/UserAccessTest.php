<?php

namespace Tests\Feature\Genre\Administration;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Genre;
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


    public function testUserCannotViewAllGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.index'));
    }


    public function testUserCannotViewCreateGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.create'));
    }


    public function testUserCannotViewEditGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $this->get(route('admin.genres.edit', $genre));
    }


    public function testUserCannotCreateGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());
    }


    public function testUserCannotUpdateGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());
    }


    public function testUserCannotDestroyGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));
    }


    public function testUserCannotDeleteGenre ()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
