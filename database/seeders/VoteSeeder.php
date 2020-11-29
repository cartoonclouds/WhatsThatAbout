<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::factory()->count(10)->create();
    }
}
