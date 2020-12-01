<?php

namespace Tests\Feature\User;

use App\Http\Middleware\VerifyAdmin;
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

}
