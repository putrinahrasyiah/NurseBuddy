<?php

namespace Database\Seeders;

use App\Models\StudyCategory;
use App\Models\StudyMaterial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $anatomy = StudyCategory::factory()->create([
            'name' => 'Anatomy',
            'description' => 'Core anatomy references and summary resources.',
        ]);

        $pharmacology = StudyCategory::factory()->create([
            'name' => 'Pharmacology',
            'description' => 'Medication study materials and memorization aids.',
        ]);

        $clinicalSkills = StudyCategory::factory()->create([
            'name' => 'Clinical Skills',
            'description' => 'Practical clinical procedures and care checklists.',
        ]);

        StudyMaterial::factory()->for($anatomy, 'category')->create([
            'title' => 'Cardiovascular System Overview PDF',
            'resource_type' => 'pdf',
            'resource_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
        ]);

        StudyMaterial::factory()->for($anatomy, 'category')->create([
            'title' => 'Respiratory Anatomy Illustration',
            'resource_type' => 'image',
            'resource_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/8a/Human_lungs_front_view.svg',
        ]);

        StudyMaterial::factory()->for($pharmacology, 'category')->create([
            'title' => 'Medication Safety Fundamentals',
            'resource_type' => 'youtube',
            'resource_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        StudyMaterial::factory()->for($pharmacology, 'category')->create([
            'title' => 'Pharmacology Flashcards',
            'resource_type' => 'quizlet',
            'resource_url' => 'https://quizlet.com/',
        ]);

        StudyMaterial::factory()->for($clinicalSkills, 'category')->create([
            'title' => 'Sterile Technique Checklist',
            'resource_type' => 'website',
            'resource_url' => 'https://www.who.int/',
        ]);

        $this->call(TaskSeeder::class);
        $this->call(ObatpediaSeeder::class);
    }
}
