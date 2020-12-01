<?php

namespace Tests\Feature\Page;

use App\Http\Middleware\VerifyAdmin;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);
    }

    public function testGuestCannotCreatePage ()
    {
        $this->expectException(AuthenticationException::class);

        $response = $this->post(route('admin.pages.store'), Page::factory()->make()->toArray());
    }

    public function testGuestCannotUpdatePage ()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->make([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->post(route('admin.pages.store', $page), Page::factory()->make()->toArray());
    }

    public function testGuestCannotDestroyPage ()
    {
        $this->expectException(AuthenticationException::class);

        $page = Page::factory()->create([
            'user_id' => User::factory()->create(),
        ]);

        $response = $this->deleteJson(route('api.admin.pages.destroy', $page));
    }
}
