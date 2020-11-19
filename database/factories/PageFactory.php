<?php

namespace Database\Factories;

use App\Models\Format;
use App\Models\Genre;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (Genre::count() === 0) {
            $genre = Genre::factory()->create();
        } else {
            $genre = Genre::inRandomOrder()->first();
        }

        if (Format::count() === 0) {
            $format = Format::factory()->create();
        } else {
            $format = Format::inRandomOrder()->first();
        }

        if (User::count() === 0) {
            $user = User::factory()->create();
        } else {
            $user = User::inRandomOrder()->first();
        }

        return [
            'title' => ucwords($this->faker->unique()->words($this->faker->numberBetween(1, 10), true), true),
            'synopsis' => $this->faker->sentences($this->faker->numberBetween(10, 50), true),
            'release_year' => $this->faker->year,
            'runtime' => $this->faker->timePeriod,
            'genre_id' => $genre,
            'format_id' => $format,
            'user_id' => $user,
        ];
    }
}
