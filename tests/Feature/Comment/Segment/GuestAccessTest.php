<?php

namespace Tests\Feature\Comment\Segment;

use App\Models\Comment;
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

    public function testGuestCannotCreateSegmentComment()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/segments/{$this->segment->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnySegmentComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnySegmentComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
