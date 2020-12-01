<?php

namespace Tests\Feature\Format\Administration;

use App\Models\Format;
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


    public function testModeratorCannotViewAllFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.index'));
    }


    public function testModeratorCannotViewCreateFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.create'));
    }


    public function testModeratorCannotViewEditFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $this->get(route('admin.formats.edit', $format));
    }


    public function testModeratorCannotCreateFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.formats.store'), Format::factory()->make()->toArray());
    }


    public function testModeratorCannotUpdateFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());
    }


    public function testModeratorCannotDestroyFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.formats.destroy', $format));
    }


    public function testModeratorCannotDeleteFormat ()
    {
        $format = Format::factory()->create();

        $this->assertFalse($this->user->can('delete', $format));
    }
}
