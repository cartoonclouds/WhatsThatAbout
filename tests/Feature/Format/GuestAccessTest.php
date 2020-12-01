<?php

namespace Tests\Feature\Format;

use App\Models\Format;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGuestCannotCreateFormat()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.formats.store'), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateFormat()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $response = $this->post(route('admin.formats.store', $format), Format::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyFormat()
    {
        $this->expectException(AuthenticationException::class);

        $format = Format::factory()->create();

        $response = $this->deleteJson(route('api.admin.formats.destroy', $format));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
