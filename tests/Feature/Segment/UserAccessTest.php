<?php

namespace Tests\Feature\Segment;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function testUserCannotCreateSegment()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate', Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateSegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), $segment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotUpdateAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroySegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testUserCannotDestroyAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testUserCannotDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $segment));
    }

    public function testUserCannotDeleteAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $segment));
    }

    public function testUserCannotRestoreSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $segment));
    }

    public function testUserCannotRestoreAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $segment));
    }

    public function testUserCannotForceDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('force-delete', $segment));
    }
}
