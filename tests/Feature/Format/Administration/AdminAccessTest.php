<?php

namespace Tests\Feature\Format\Administration;

use App\Models\Format;
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


    public function testAdminCanViewAllFormats ()
    {
        $this->actingAs($this->user)->get(route('admin.formats.index'))->assertSuccessful();
    }


    public function testAdminCanViewCreateFormats ()
    {
        $this->actingAs($this->user)->get(route('admin.formats.create'))->assertSuccessful();
    }


    public function testAdminCanViewEditFormats ()
    {
        $format = Format::factory()->create();

        $this->actingAs($this->user)->get(route('admin.formats.edit', $format))->assertSuccessful();
    }


    public function testAdminCanCreateFormat ()
    {
        $response = $this->actingAs($this->user)->post(route('admin.formats.store'), Format::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCanUpdateFormat ()
    {
        $format = Format::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());

        $response->assertSuccessful();
    }


    public function testAdminCannotDestroyFormat ()
    {
        $this->expectException(AuthorizationException::class);

        $format = Format::factory()->create();

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.formats.destroy', $format));
    }


    public function testAdminCannotDeleteFormat ()
    {
        $format = Format::factory()->create();

        $this->assertFalse($this->user->can('delete', $format));
    }
}
