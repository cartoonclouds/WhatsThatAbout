<?php

namespace Database\Factories;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Theme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'definition' => $this->faker->sentence,
            'icon' => function (array $theme) {
                return 'data:image/png;base64,';// . $this->faker->base64Image('placeholder', '250x250', 'png', 'cccccc', '999999', $theme['theme']);
            },
        ];
    }
}
