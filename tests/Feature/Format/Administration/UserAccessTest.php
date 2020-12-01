<?php

namespace Tests\Feature\Format\Administration;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Format;
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


    public function testUserCannotViewAllFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.index'));
    }


    public function testUserCannotViewCreateFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.create'));
    }


    public function testUserCannotViewEditFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $this->get(route('admin.formats.edit', $format));
    }


    public function testUserCannotCreateFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.formats.store'), Format::factory()->make()->toArray());
    }


    public function testUserCannotUpdateFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());
    }


    public function testUserCannotDestroyFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.formats.destroy', $format));
    }


    public function testUserCannotDeleteFormat ()
    {
        $format = Format::factory()->create();

        $this->assertFalse($this->user->can('delete', $format));
    }
}
