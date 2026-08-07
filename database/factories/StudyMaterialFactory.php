<?php

namespace Database\Factories;

use App\Models\StudyCategory;
use App\Models\StudyMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudyMaterial>
 */
class StudyMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => StudyCategory::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->optional()->paragraph(),
            'resource_type' => fake()->randomElement(StudyMaterial::RESOURCE_TYPES),
            'resource_url' => fake()->url(),
            'thumbnail' => fake()->optional()->imageUrl(),
        ];
    }
}
