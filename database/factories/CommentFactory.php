<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Page;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $commentable_type = $this->faker->randomElement([
            Page::class,
            Segment::class,
            //User::class
        ]);

        if ($commentable_type::count() === 0) {
            $commentable_id = $commentable_type::factory()->create();
        } else {
            $commentable_id = $commentable_type::all()->random()->id;
        }

        return [
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
            'user_id' => User::factory(),
            'title' => $this->faker->words($this->faker->numberBetween(1, 10), true),
            'body' => $this->faker->sentence($this->faker->numberBetween(10, 50), true),
        ];
    }
}
