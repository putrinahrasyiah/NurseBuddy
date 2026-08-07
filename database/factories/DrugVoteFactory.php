<?php

namespace Database\Factories;

use App\Models\Drug;
use App\Models\DrugVote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DrugVote>
 */
class DrugVoteFactory extends Factory
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
            'drug_id' => Drug::factory(),
            'vote' => fake()->randomElement(DrugVote::VOTES),
        ];
    }
}
