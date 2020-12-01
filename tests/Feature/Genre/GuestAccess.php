<?php

namespace Tests\Feature\Genre;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccess extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGuestCannotCreateGenre()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.genres.store'), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateGenre()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $response = $this->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyGenre()
    {
        $this->expectException(AuthenticationException::class);

        $genre = Genre::factory()->create();

        $response = $this->deleteJson(route('api.admin.genres.destroy', $genre));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
