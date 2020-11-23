<?php

namespace Tests\Feature\Segment;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCanCreateSegment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate', Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCanUpdateSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), $segment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCannotUpdateAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testModeratorCanDestroySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testModeratorCannotDestroyAnySegment()
    {
        $this->expectException(AuthorizationException::class);

        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }


    public function testModeratorCanDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $segment));
    }

    public function testModeratorCannotDeleteAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('delete', $segment));
    }

    public function testModeratorCannotRestoreSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('restore', $segment));
    }

    public function testModeratorCannotRestoreAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertFalse($this->user->can('restore', $segment));
    }

    public function testModeratorCannotForceDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('force-delete', $segment));
    }
}
