<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\Reference;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $referenceable_type = $this->faker->randomElement([
            Page::class,
            Segment::class,
        ]);

        if ($referenceable_type::count() === 0) {
            $referenceable_id = $referenceable_type::factory()->create();
        } else {
            $referenceable_id = $referenceable_type::inRandomOrder()->first();
        }

        if (User::count() === 0) {
            $user = User::factory()->create();
        } else {
            $user = User::inRandomOrder()->first();
        }

        return [
            'referenceable_type' => $referenceable_type,
            'referenceable_id' => $referenceable_id,
            'user_id' => $user,
        ];
    }
}
