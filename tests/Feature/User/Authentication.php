<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class Authentication extends TestCase
{
    private $newUserDetails;

    public function setUp(): void
    {
        parent::setUp();

        $this->newUserDetails = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'username' => 'jdoe',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        //https://medium.com/@DCzajkowski/testing-laravel-authentication-flow-573ea0a96318
    }

    public function testUserCanRegister()
    {
        // GET route('register')
        $this->expectsEvents(Registered::class);

        $this->assertGuest();

        $this->post('/register', $this->newUserDetails)->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testRegisteredUserReceivesVerificationEmail()
    {
        Notification::fake();

        // Assert that no notifications were sent...
        Notification::assertNothingSent();

        $this->post('/register', $this->newUserDetails);

        $this->assertDatabaseHas('users',[
            'name' => $this->newUserDetails['name'],
            'username' => $this->newUserDetails['username'],
            'email' => $this->newUserDetails['email'],
        ])->assertAuthenticated();

        $user = $this->app->make('auth')->guard('web')->user();

        // Assert a notification was sent to the given users...
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    /*
    public function testRegisteredUserCanVerifyAccount()
    {
        // GET route('verification.verify') - verify with the url
    }

    public function testUnverifiedUserCanRequestNewVerificationEmail()
    {
        // GET route('verification.notice') - verify page
        // POST route('verification.send')
        // GET route('verification.verify') - verify with the url
    }

    public function testUserForgotPassword()
    {
        // GET route('password.request')
        // POST route('password.email')
    }

    public function testUserCanResetPassword()
    {
        // GET route('password.reset')
        // POST route('password.update')
    }
    */

    public function testUserCanLogin()
    {
        $this->expectsEvents(Login::class);

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanLogout()
    {
        $this->expectsEvents(Logout::class);

        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout')->assertRedirect('/');

        $this->assertGuest();
    }
}
