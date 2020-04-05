<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
//use Laracasts\TestDummy\DbTestCase as BaseTestCase;
use Artisan, DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the DB before each test.
     */
    public function setUp(): void
    {
        parent::setUp();

        // This should only do work for Sqlite DBs in memory.
        Artisan::call('migrate');

        // We'll run all tests through a transaction,
        // and then rollback afterward.
        DB::beginTransaction();
    }

    /**
     * Rollback transactions after each test.
     */
    public function tearDown(): void
    {
        DB::rollback();

        parent::tearDown();
    }
}
