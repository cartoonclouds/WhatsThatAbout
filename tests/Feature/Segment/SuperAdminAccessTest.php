<?php

namespace Tests\Feature\Segment;

use App\Models\Segment;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SuperAdminAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_SUPER_ADMIN);
    }

    public function testSuperAdminCanCreateSegment()
    {
        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate', Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdateSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), $segment->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanUpdateAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->postJson('/api/segments/updateOrCreate/' . $segment->getRouteKey(), Segment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }

    public function testSuperAdminCanDestroyAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson('/api/segments/' . $segment->getRouteKey());

        $response->assertStatus(Response::HTTP_OK);
    }


    public function testSuperAdminCanDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('delete', $segment));
    }

    public function testSuperAdminCanDeleteAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('delete', $segment));
    }

    public function testSuperAdminCanRestoreSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('restore', $segment));
    }

    public function testSuperAdminCanRestoreAnySegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $this->assertTrue($this->user->can('restore', $segment));
    }

    public function testSuperAdminCanForceDeleteSegment()
    {
        $segment = Segment::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->assertTrue($this->user->can('force-delete', $segment));
    }
}
