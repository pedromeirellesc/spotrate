<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::Factory()->create()->id,
            'place_id' => Place::Factory()->create()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->optional()->paragraph,
            'created_by' => User::factory()->create()->id,
            'updated_by' => null,
            'deleted_by' => null,
        ];
    }
}
