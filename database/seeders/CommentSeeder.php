<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            Comment::factory()->count(50)->create();

        } catch (QueryException $e) {

        }
    }
}
