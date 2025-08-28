<?php

namespace Database\Factories;

use App\Models\Incident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncidentUpdate>
 */
class IncidentUpdateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'incident_id' => Incident::factory(),
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement(['investigating', 'identified', 'monitoring', 'resolved']),
        ];
    }

    /**
     * Indicate that the update is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'message' => 'This incident has been resolved.',
        ]);
    }

    /**
     * Indicate that the update is investigating.
     */
    public function investigating(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'investigating',
            'message' => 'We are currently investigating this issue.',
        ]);
    }
}