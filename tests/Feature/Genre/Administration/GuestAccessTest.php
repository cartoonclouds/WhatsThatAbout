<?php

namespace Tests\Feature\Genre\Administration;

use App\Models\Genre;
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


    public function testGuestCannotViewAllGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.index'));
    }


    public function testGuestCannotViewCreateGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.genres.create'));
    }


    public function testGuestCannotViewEditGenres ()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $this->get(route('admin.genres.edit', $genre));
    }


    public function testGuestCannotCreateGenre ()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.genres.store'), Genre::factory()->make()->toArray());
    }

    public function testGuestCannotUpdateGenre ()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $response = $this->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());
    }

    public function testGuestCannotDestroyGenre ()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $response = $this->deleteJson(route('api.admin.genres.destroy', $genre));
    }
}
