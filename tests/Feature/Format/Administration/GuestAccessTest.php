<?php

namespace Tests\Feature\Format\Administration;

use App\Models\Format;
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


    public function testGuestCannotViewAllFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.index'));
    }


    public function testGuestCannotViewCreateFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $this->get(route('admin.formats.create'));
    }


    public function testGuestCannotViewEditFormats ()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $this->get(route('admin.formats.edit', $format));
    }


    public function testGuestCannotCreateFormat ()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.formats.store'), Format::factory()->make()->toArray());
    }

    public function testGuestCannotUpdateFormat ()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $response = $this->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());
    }

    public function testGuestCannotDestroyFormat ()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $response = $this->deleteJson(route('api.admin.formats.destroy', $format));
    }
}
