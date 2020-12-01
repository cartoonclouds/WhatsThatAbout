<?php

namespace Tests\Feature\Page;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Page;
use App\Models\User;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();

        $this->user->assignRole(User::ROLE_ADMIN);
    }

    public function testAdminCanCreatePage ()
    {
        $response = $this->actingAs($this->user)->post(route('admin.pages.store'), Page::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testAdminCanUpdatePage ()
    {
        $page = Page::factory()->make([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testAdminCanUpdateAnyPage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user)->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());

        $response->assertSuccessful();
    }

    public function testAdminCanDestroyPage ()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.pages.destroy', $page));

        $response->assertSuccessful();
    }

    public function testAdminCanDestroyAnyPage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->actingAs($this->user, 'api')->deleteJson(route('api.admin.pages.destroy', $page));

        $response->assertSuccessful();
    }


    public function testAdminCanDeletePage ()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testAdminCanDeleteAnyPage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertTrue($this->user->can('delete', $page));
    }

    public function testAdminCanRestorePage ()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testAdminCanRestoreAnyPage ()
    {
        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $this->assertTrue($this->user->can('restore', $page));
    }

    public function testAdminCannotForceDeletePage ()
    {
        $page = Page::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->assertFalse($this->user->can('force-delete', $page));
    }
}
