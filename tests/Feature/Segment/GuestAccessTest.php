<?php

namespace Tests\Feature\Segment;

use App\Models\Segment;
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

    public function testGuestCannotCreateSegment()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson('/api/segments/updateOrCreate', Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateSegment()
    {
        $this->expectException(AuthenticationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), $segment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnySegment()
    {
        $this->expectException(AuthenticationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroySegment()
    {
        $this->expectException(AuthenticationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnySegment()
    {
        $this->expectException(AuthenticationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
