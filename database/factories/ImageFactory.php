<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Page;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageable_type = $this->faker->randomElement([
            Page::class,
            Scene::class,
            User::class
        ]);

        if ($imageable_type::count() === 0) {
            $imageable_id = $imageable_type::factory();
        } else {
            $imageable_id = $imageable_type::inRandomOrder()->first();
        }

        return [
            'imageable_type' => $imageable_type,
            'imageable_id' => $imageable_id,
            'file_path' => $this->faker->image(),
            'cover' => $this->faker->boolean,
            'hero' => $this->faker->boolean,
        ];
    }
}
