<?php

namespace Database\Factories;

use App\Enums\StatusTasks;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement(StatusTasks::values()), // Random status from the enum
            'due_date' => $this->faker->date,
            'client_id' => rand(1, 10), // Associate with a client
            'project_id' => rand(1, 5), // Optionally associate with a project
        ];
    }
}
