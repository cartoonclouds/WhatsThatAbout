<?php

namespace Tests\Feature\User;

use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserAccessTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /*
    public function testUserCanUpdateProfileInformation()
    {
        // PUT route('user-profile-information.update')
    }

    public function testUserCanUpdatePassword()
    {
        // PUT route('user-password.update')
    }

    public function testUserCanConfirmPassword()
    {
        // GET route('password.confirmation') return the password confirmation status
        // GET route('password.confirm')
        // POST url('user/confirm-password')
    }
    */
}
