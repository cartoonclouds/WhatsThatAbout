<?php

namespace Tests\Feature\Segment;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }

    public function testAdminCanCreateSegment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate', Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), $segment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanUpdateAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testAdminCanDestroyAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testAdminCanDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $segment));
    }

    public function testAdminCanDeleteAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $segment));
    }

    public function testAdminCanRestoreSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $segment));
    }

    public function testAdminCanRestoreAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $segment));
    }

    public function testAdminCannotForceDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertFalse($this->user->can('force-delete', $segment));
    }
}
