<?php

namespace Database\Factories;

use App\Models\StudyMaterial;
use App\Models\StudyMaterialProgress;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StudyMaterialProgress>
 */
class StudyMaterialProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'study_material_id' => StudyMaterial::factory(),
            'status' => fake()->randomElement(StudyMaterialProgress::STATUSES),
        ];
    }
}
