<?php

namespace Database\Factories;

use App\Models\Segment;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SegmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Segment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => $this->faker->time(),
            'finish_time' => $this->faker->time(),
            'runs_throughout' => $this->faker->boolean,
            'details' => $this->faker->paragraphs($this->faker->numberBetween(10, 50), true),
            //'references' => $this->faker->,
            'show_id' => Show::factory(),
            'user_id' => User::factory(),
        ];
    }
}
