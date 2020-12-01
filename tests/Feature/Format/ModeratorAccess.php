<?php

namespace Tests\Feature\Format;

use App\Models\Format;
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


    public function testModeratorCannotCreateFormat()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.formats.store'), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotUpdateFormat()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDestroyFormat()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.formats.destroy', $format));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCannotDeleteFormat()
    {
        $format = Format::factory()->create();

        $this->assertFalse($this->user->can('delete', $format));
    }
}
