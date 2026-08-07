<?php

use App\Models\StudyCategory;
use App\Models\StudyMaterial;
use App\Models\StudyMaterialProgress;
use App\Models\User;

test('guest cannot access study library pages', function () {
    $category = StudyCategory::factory()->create();
    $material = StudyMaterial::factory()->for($category, 'category')->create();

    $this->get(route('study-library.index'))->assertRedirect(route('login'));
    $this->get(route('study-library.by-category', $category))->assertRedirect(route('login'));
    $this->get(route('study-library.show', $material))->assertRedirect(route('login'));
    $this->patch(route('study-library.status', $material), [
        'status' => 'done',
    ])->assertRedirect(route('login'));
});

test('user can browse and filter study materials', function () {
    $user = User::factory()->create();

    $anatomy = StudyCategory::factory()->create(['name' => 'Anatomy']);
    $pharmacology = StudyCategory::factory()->create(['name' => 'Pharmacology']);

    $keep = StudyMaterial::factory()->for($anatomy, 'category')->create([
        'title' => 'Cardiac Anatomy Basics',
        'resource_type' => 'pdf',
    ]);

    $skip = StudyMaterial::factory()->for($pharmacology, 'category')->create([
        'title' => 'Antibiotic Overview',
        'resource_type' => 'youtube',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('study-library.index', [
            'category' => $anatomy->id,
            'resource_type' => 'pdf',
            'search' => 'Cardiac',
        ]));

    $response
        ->assertOk()
        ->assertSee($keep->title)
        ->assertDontSee($skip->title);
});

test('user can view material details', function () {
    $user = User::factory()->create();
    $material = StudyMaterial::factory()->create([
        'title' => 'IV Infusion Guide',
        'resource_type' => 'website',
        'resource_url' => 'https://example.com/iv-guide',
    ]);

    $this->actingAs($user)
        ->get(route('study-library.show', $material))
        ->assertOk()
        ->assertSee('IV Infusion Guide')
        ->assertSee('Open Resource');
});

test('user can change material status from pending to done', function () {
    $user = User::factory()->create();
    $material = StudyMaterial::factory()->create();

    $this->actingAs($user)
        ->patch(route('study-library.status', $material), [
            'status' => 'done',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $this->assertDatabaseHas('study_material_progresses', [
        'user_id' => $user->id,
        'study_material_id' => $material->id,
        'status' => 'done',
    ]);
});

test('changing status only affects current user', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $material = StudyMaterial::factory()->create();

    StudyMaterialProgress::factory()->for($userB)->for($material)->create([
        'status' => 'pending',
    ]);

    $this->actingAs($userA)
        ->patch(route('study-library.status', $material), [
            'status' => 'done',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('study_material_progresses', [
        'user_id' => $userA->id,
        'study_material_id' => $material->id,
        'status' => 'done',
    ]);

    $this->assertDatabaseHas('study_material_progresses', [
        'user_id' => $userB->id,
        'study_material_id' => $material->id,
        'status' => 'pending',
    ]);
});
