<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComponentGroup>
 */
class ComponentGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_expanded' => fake()->boolean(80),
        ];
    }

    /**
     * Indicate that the component group is collapsed.
     */
    public function collapsed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_expanded' => false,
        ]);
    }
}