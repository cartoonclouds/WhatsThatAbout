<?php

namespace Tests\Feature\Genre\Administration;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }


    public function testAdminCanViewAllGenres ()
    {
        $this->actingAs($this->user)->get(route('admin.genres.index'))->assertSuccessful();
    }


    public function testAdminCanViewCreateGenres ()
    {
        $this->actingAs($this->user)->get(route('admin.genres.create'))->assertSuccessful();
    }


    public function testAdminCanViewEditGenres ()
    {
        $genre = Genre::factory()->create();

        $this->actingAs($this->user)->get(route('admin.genres.edit', $genre))->assertSuccessful();
    }


    public function testAdminCanCreateGenre ()
    {
        $response = $this->actingAs($this->user)->post(route('admin.genres.store'), Genre::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCanUpdateGenre ()
    {
        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.genres.store', $genre), Genre::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCannotDestroyGenre ()
    {
        $this->expectException(AuthorizationException::class);

        $genre = Genre::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.genres.destroy', $genre));
    }


    public function testAdminCannotDeleteGenre ()
    {
        $genre = Genre::factory()->create();

        $this->assertFalse($this->user->can('delete', $genre));
    }
}
