<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => $this->faker->company,
            'vat' => $this->faker->unique()->numberBetween(10000, 99999), // Generate a unique 5-digit VAT number
            'address' => $this->faker->address,
        ];
    }
}
