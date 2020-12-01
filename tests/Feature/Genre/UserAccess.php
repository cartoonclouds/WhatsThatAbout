<?php

namespace Tests\Feature\Genre;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccess extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();
    }


    public function testUserCannotCreateGenre()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotUpdateGenre()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDestroyGenre()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDeleteGenre()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
