<?php

namespace Tests\Feature\Theme;

use App\Http\Middleware\VerifyAdmin;
use App\Models\User;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    protected $user;

    public function setUp ()
    : void
    {
        parent::setUp();

        $this->withoutMiddleware(VerifyAdmin::class);

        $this->user = User::factory()->create();
    }

}
