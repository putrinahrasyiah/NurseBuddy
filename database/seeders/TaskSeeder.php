<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Seed the application's database with sample tasks.
     */
    public function run(): void
    {
        $user = User::query()->first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tasks = [
            [
                'title' => 'Review cardiovascular notes',
                'description' => 'Summarize key points from chapter 3 and create a quick recap.',
                'priority' => 'high',
                'status' => 'in_progress',
                'deadline' => now()->addDays(1)->toDateString(),
                'is_urgent' => true,
            ],
            [
                'title' => 'Practice dosage calculation',
                'description' => 'Complete 20 medication dosage questions from worksheet.',
                'priority' => 'high',
                'status' => 'pending',
                'deadline' => now()->addDays(2)->toDateString(),
                'is_urgent' => false,
            ],
            [
                'title' => 'Prepare patient communication script',
                'description' => 'Draft a short script for patient education simulation.',
                'priority' => 'medium',
                'status' => 'pending',
                'deadline' => now()->addDays(3)->toDateString(),
                'is_urgent' => false,
            ],
            [
                'title' => 'Watch sterile technique tutorial',
                'description' => 'Take notes on hand hygiene and sterile field setup.',
                'priority' => 'medium',
                'status' => 'done',
                'deadline' => now()->subDay()->toDateString(),
                'is_urgent' => false,
            ],
            [
                'title' => 'Organize clinical checklist',
                'description' => 'Update and print the weekly clinical skills checklist.',
                'priority' => 'low',
                'status' => 'pending',
                'deadline' => now()->addDays(5)->toDateString(),
                'is_urgent' => false,
            ],
        ];

        foreach ($tasks as $task) {
            Task::query()->updateOrCreate(
                [
                    'user_id' => $user->id,
                    'title' => $task['title'],
                ],
                $task
            );
        }
    }
}
