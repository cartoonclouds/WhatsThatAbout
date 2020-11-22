<?php

namespace Database\Factories;

use App\Models\Format;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Format::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'format' => $this->faker->unique()->mediaFormat,
            'definition' => $this->faker->paragraph,
            'icon' => function (array $format) {
                return 'data:image/png;base64,';// . $this->faker->base64Image('placeholder', '250x250', 'png', 'cccccc', '999999', $format['format']);
            },
        ];
    }
}
