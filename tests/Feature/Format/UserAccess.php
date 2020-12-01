<?php

namespace Tests\Feature\Format;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Format;
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


    public function testUserCannotCreateFormat()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.formats.store'), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotUpdateFormat()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDestroyFormat()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.formats.destroy', $format));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDeleteFormat()
    {
        $format = Format::factory()->create();

        $this->assertFalse($this->user->can('delete', $format));
    }
}
