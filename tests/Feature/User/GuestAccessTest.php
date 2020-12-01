<?php

namespace Tests\Feature\User;

use App\Models\Scene;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Tests\TestCase;

class GuestAccessTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

}
