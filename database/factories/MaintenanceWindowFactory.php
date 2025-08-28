<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceWindow>
 */
class MaintenanceWindowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $scheduledStart = fake()->dateTimeBetween('now', '+30 days');
        $scheduledEnd = fake()->dateTimeBetween($scheduledStart, $scheduledStart->format('Y-m-d H:i:s') . ' +4 hours');
        
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['scheduled', 'in_progress', 'completed']),
            'scheduled_start' => $scheduledStart,
            'scheduled_end' => $scheduledEnd,
            'actual_start' => null,
            'actual_end' => null,
        ];
    }

    /**
     * Indicate that the maintenance is scheduled.
     */
    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'scheduled',
            'actual_start' => null,
            'actual_end' => null,
        ]);
    }

    /**
     * Indicate that the maintenance is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
            'actual_start' => fake()->dateTimeBetween($attributes['scheduled_start'], 'now'),
            'actual_end' => null,
        ]);
    }

    /**
     * Indicate that the maintenance is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'actual_start' => fake()->dateTimeBetween($attributes['scheduled_start'], $attributes['scheduled_end']),
            'actual_end' => fake()->dateTimeBetween($attributes['scheduled_start'], $attributes['scheduled_end']),
        ]);
    }
}