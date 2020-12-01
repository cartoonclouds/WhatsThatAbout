<?php

namespace Tests\Feature\Page;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\TestCase;

class ModeratorAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_MOD);
    }

    public function testModeratorCannotCreatePage ()
    {
        $this->expectException(AuthorizationException::class);

        $response = $this->actingAs($this->user)->post(route('admin.pages.store'), Page::factory()->make()->toArray());
    }

    public function testModeratorCannotUpdatePage ()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());
    }

    public function testModeratorCannotUpdateAnyPage ()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testModeratorCannotDestroyPage ()
    {
        $this->expectException(AuthorizationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.pages.destroy', $page));
    }

    public function testModeratorCannotDeletePage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertFalse($this->user->can('delete', $page));
    }

    public function testModeratorCannotRestorePage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertFalse($this->user->can('restore', $page));
    }

    public function testModeratorCannotForceDeletePage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertFalse($this->user->can('force-delete', $page));
    }
}
