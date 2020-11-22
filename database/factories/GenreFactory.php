<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Genre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'genre' => $this->faker->unique()->genre,
            'definition' => $this->faker->paragraph,
            'icon' => function (array $genre) {
                return 'data:image/png;base64,';// . $this->faker->base64Image('placeholder', '250x250', 'png', 'cccccc', '999999', $genre['genre']);
            },
        ];
    }
}
