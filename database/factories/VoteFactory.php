<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Segment;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $votable_type = $this->faker->randomElement([
            Page::class,
            Segment::class,
            //User::class
        ]);

        if ($votable_type::count() === 0) {
            $votable_id = $votable_type::factory()->create();
        } else {
            $votable_id = $votable_type::all()->random()->id;
        }

        if (User::count() === 0) {
            $user = User::factory()->create();
        } else {
            $user = User::inRandomOrder()->first();
        }

        return [
            'votable_type' => $votable_type,
            'votable_id' => $votable_id,
            'user_id' => $user,
            'vote' => $this->faker->boolean,
        ];
    }
}
