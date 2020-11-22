<?php

namespace Database\Factories;

use App\Models\Theme;
use App\Models\Genre;
use App\Models\Segment;
use App\Models\Page;
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
        if (Page::count() === 0) {
            $page = Page::factory()->create();
        } else {
            $page = Page::inRandomOrder()->first();
        }

        if (Theme::count() === 0) {
            $theme = Theme::factory()->create();
        } else {
            $theme = Theme::inRandomOrder()->first();
        }

        if (Genre::count() === 0) {
            $genre = Genre::factory()->create();
        } else {
            $genre = Genre::inRandomOrder()->first();
        }

        if (User::count() === 0) {
            $user = User::factory()->create();
        } else {
            $user = User::inRandomOrder()->first();
        }

        return [
            'title' => $this->faker->unique()->words($this->faker->numberBetween(1, 5), true),
            'start_time' => $this->faker->time(),
            'finish_time' => $this->faker->time(),
            'runs_throughout' => $this->faker->boolean,
            'details' => $this->faker->paragraph($this->faker->numberBetween(10, 30), true),
            'page_id' => $page,
            'theme_id' => $theme,
            'genre_id' => $genre,
            'user_id' => $user,
        ];
    }
}
