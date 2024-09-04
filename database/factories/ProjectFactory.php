<?php

namespace Database\Factories;

use App\Enums\StatusProjects;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = \App\Models\Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true), // Generate a random title
            'slug' => $this->faker->unique()->slug, // Generate a unique slug
            'body' => $this->faker->paragraph, // Generate a random body text
            'deadline' => $this->faker->optional()->dateTime, // Generate an optional deadline
            'status' => $this->faker->randomElement(StatusProjects::values()), // Random status from the enum
            'user_id' => rand(1, 5), // Associate with a user
            'client_id' => rand(1, 10), // Associate with a client
        ];
    }
}
