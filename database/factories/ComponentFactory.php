<?php

namespace Database\Factories;

use App\Models\ComponentGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'component_group_id' => ComponentGroup::factory(),
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['operational', 'degraded', 'partial_outage', 'major_outage']),
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the component is operational.
     */
    public function operational(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'operational',
        ]);
    }

    /**
     * Indicate that the component is degraded.
     */
    public function degraded(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'degraded',
        ]);
    }

    /**
     * Indicate that the component has a partial outage.
     */
    public function partialOutage(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'partial_outage',
        ]);
    }

    /**
     * Indicate that the component has a major outage.
     */
    public function majorOutage(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'major_outage',
        ]);
    }
}