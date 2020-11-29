<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Format::factory()->count(6)->create();
    }
}
