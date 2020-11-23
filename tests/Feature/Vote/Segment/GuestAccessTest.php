<?php

namespace Tests\Feature\Vote\Segment;

use App\Models\Vote;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    protected $segment;

    public function setUp(): void
    {
        parent::setUp();

        $this->segment = Segment::factory()->create();
    }

    public function testGuestCanCreateSegmentVote()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/segments/{$this->segment->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnySegmentVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnySegmentVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
