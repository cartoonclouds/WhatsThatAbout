<?php

namespace Database\Factories;

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
        return [
            'title' => $this->faker->unique()->words($this->faker->numberBetween(1, 10), true),
            'synopsis' => $this->faker->sentences($this->faker->numberBetween(10, 50), true),
            'release_year' => $this->faker->year,
            'thumbnail' => $this->faker->image(),
            'runtime' => $this->faker->time(),
            'references' => ['imdb_id' => $this->faker->numerify('#######')],
            'user_id' => User::factory(),
        ];
    }
}
