<?php

namespace Database\Factories;

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
            'instagram' => $this->faker->userName,
            'whatsapp' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'created_by' => 1,
            'updated_by' => null,
            'deleted_by' => null,
        ];
    }
}
