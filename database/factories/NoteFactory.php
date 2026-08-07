<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
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
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(2, true),
            'tags' => fake()->optional()->randomElement([
                'pharmacology,exam',
                'anatomy,clinical',
                'nursing-basics',
            ]),
            'is_pinned' => fake()->boolean(25),
        ];
    }
}
