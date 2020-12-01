<?php

namespace Tests\Feature\Comment\Page;

use App\Models\Comment;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccess extends TestCase
{
    protected $page;

    public function setUp(): void
    {
        parent::setUp();

        $this->page = Page::factory()->create();
    }

    public function testGuestCannotCreatePageComment()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/pages/{$this->page->slug}/comments", Comment::factory()->make()->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotUpdateAnyPageComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGuestCannotDestroyAnyPageComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
