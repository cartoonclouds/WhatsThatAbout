<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use CreatesApplication;
    use WithFaker;

    protected bool $withSeed = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->withoutExceptionHandling();
    }
}
