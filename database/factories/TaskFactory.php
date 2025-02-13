<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\User;
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
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'title' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(array_column(TaskStatus::cases(), 'value')),
            'user_id' => User::factory(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
