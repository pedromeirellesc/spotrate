<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'instagram' => $this->faker->userName,
            'whatsapp' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'created_by' => function () {
                return User::factory()->create()->id;
            },
            'updated_by' => null,
            'deleted_by' => null,
        ];
    }
}
