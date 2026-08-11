<?php

use App\Models\MoodEntry;
use App\Models\Note;
use App\Models\StudyMaterial;
use App\Models\StudyMaterialProgress;
use App\Models\Task;
use App\Models\User;

test('guest cannot access dashboard', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('dashboard shows integrated data for authenticated user', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Task::factory()->for($user)->create([
        'title' => 'Today high priority task',
        'status' => 'in_progress',
        'priority' => 'high',
        'deadline' => now()->toDateString(),
        'is_urgent' => true,
    ]);

    Task::factory()->for($user)->create([
        'title' => 'Overdue pending task',
        'status' => 'pending',
        'priority' => 'medium',
        'deadline' => now()->subDay()->toDateString(),
        'is_urgent' => false,
    ]);

    MoodEntry::factory()->for($user)->create([
        'mood' => 'happy',
        'entry_date' => now()->toDateString(),
    ]);

    $materialDone = StudyMaterial::factory()->create();
    $materialPending = StudyMaterial::factory()->create();

    StudyMaterialProgress::factory()->for($user)->for($materialDone, 'studyMaterial')->create([
        'status' => 'done',
    ]);

    StudyMaterialProgress::factory()->for($user)->for($materialPending, 'studyMaterial')->create([
        'status' => 'pending',
    ]);

    Note::factory()->for($user)->create([
        'title' => 'Pinned pharmacology summary',
        'content' => 'Quick notes for exam revision.',
        'is_pinned' => true,
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response
        ->assertOk()
        ->assertSee('Today\'s Tasks')
        ->assertSee('Today high priority task')
        ->assertSee('Mood Summary')
        ->assertSee('Study Progress')
        ->assertSee('Recent Notes')
        ->assertSee('Quick Access')
        ->assertSee('Reward Tree (V1 UI)')
        ->assertSee('Pinned pharmacology summary');
});

test('dashboard only shows current user records', function () {
    $owner = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $otherUser = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    Task::factory()->for($owner)->create([
        'title' => 'Owner task visible',
        'status' => 'pending',
        'deadline' => now()->toDateString(),
    ]);

    Task::factory()->for($otherUser)->create([
        'title' => 'Other user task hidden',
        'status' => 'pending',
        'deadline' => now()->toDateString(),
    ]);

    Note::factory()->for($owner)->create([
        'title' => 'Owner note visible',
    ]);

    Note::factory()->for($otherUser)->create([
        'title' => 'Other user note hidden',
    ]);

    MoodEntry::factory()->for($otherUser)->create([
        'mood' => 'stressed',
        'entry_date' => now()->toDateString(),
    ]);

    $response = $this->actingAs($owner)->get(route('dashboard'));

    $response
        ->assertOk()
        ->assertSee('Owner task visible')
        ->assertDontSee('Other user task hidden')
        ->assertSee('Owner note visible')
        ->assertDontSee('Other user note hidden');
});
