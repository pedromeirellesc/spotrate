<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'place_id' => 1,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->paragraph,
            'created_by' => 1,
            'updated_by' => null,
            'deleted_by' => null,
        ];
    }
}
