<?php

namespace Database\Seeders;

use App\Models\Segment;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Segment::factory()->count(10)->create();

        } catch (QueryException $e) {

        }
    }
}
