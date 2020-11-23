<?php

namespace Tests\Feature\Vote\Page;

use App\Models\Vote;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    protected $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->page = Page::factory()->create();
    }

    public function testGuestCannotCreatePageVote()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/pages/{$this->page->slug}/votes", Vote::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnyPageVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnyPageVote()
    {
        $this->expectException(AuthenticationException::class);

        $vote = Vote::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/votes/" . $vote->getRouteKey(), $vote->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
