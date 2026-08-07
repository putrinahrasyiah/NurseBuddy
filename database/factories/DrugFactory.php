<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Drug>
 */
class DrugFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'generic_name' => fake()->optional()->words(2, true),
            'description' => fake()->sentence(),
            'indication' => fake()->sentence(),
            'dosage' => fake()->randomElement(['500 mg every 8 hours', '10 mg once daily', '5 ml three times daily']),
            'route' => fake()->randomElement(['Oral', 'IV', 'Topical']),
            'contraindication' => fake()->sentence(),
            'side_effects' => fake()->sentence(),
        ];
    }
}
