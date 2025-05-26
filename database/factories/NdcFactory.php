<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ndc>
 */
class NdcFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ndc_code' => sprintf(
                '%05d-%04d-%02d',
                $this->faker->numberBetween(10000, 99999),
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(10, 99)
            ),
            'brand_name' => fake()->company(),
            'generic_name' => fake()->word(),
            'labeler_name' => fake()->name(),
            'product_type' => fake()->randomElement(['Tablet', 'Capsule', 'Injection', 'Solution']),
        ];
    }
}
