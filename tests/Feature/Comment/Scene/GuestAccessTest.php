<?php

namespace Tests\Feature\Comment\Scene;

use App\Models\Comment;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{

    protected $scene;

    public function setUp(): void
    {
        parent::setUp();

        $this->scene = Scene::factory()->create();
    }

    public function testGuestCannotCreateSceneComment()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->postJson("/api/scenes/{$this->scene->slug}/comments", Comment::factory()->make()->toArray());
    }

    public function testGuestCannotUpdateAnySceneComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->putJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());
    }

    public function testGuestCannotDestroyAnySceneComment()
    {
        $this->expectException(AuthenticationException::class);

        $comment = Comment::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->deleteJson("/api/comments/" . $comment->getRouteKey(), $comment->toArray());
    }
}
