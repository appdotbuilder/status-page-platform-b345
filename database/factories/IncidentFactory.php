<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-7 days', 'now');
        
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['investigating', 'identified', 'monitoring', 'resolved']),
            'impact' => fake()->randomElement(['none', 'minor', 'major', 'critical']),
            'started_at' => $startedAt,
            'resolved_at' => fake()->boolean(60) ? fake()->dateTimeBetween($startedAt, 'now') : null,
        ];
    }

    /**
     * Indicate that the incident is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'resolved_at' => fake()->dateTimeBetween($attributes['started_at'], 'now'),
        ]);
    }

    /**
     * Indicate that the incident is ongoing.
     */
    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => fake()->randomElement(['investigating', 'identified', 'monitoring']),
            'resolved_at' => null,
        ]);
    }

    /**
     * Indicate that the incident is critical.
     */
    public function critical(): static
    {
        return $this->state(fn (array $attributes) => [
            'impact' => 'critical',
        ]);
    }
}