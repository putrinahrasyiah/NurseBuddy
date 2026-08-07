<?php

use App\Models\Task;
use App\Models\User;

test('guest cannot access task pages', function () {
    $this->get(route('tasks.index'))->assertRedirect(route('login'));
    $this->get(route('tasks.create'))->assertRedirect(route('login'));
    $this->post(route('tasks.store'), [])->assertRedirect(route('login'));
});

test('user can create a task', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('tasks.store'), [
            'title' => 'Prepare clinical case review',
            'description' => 'Read chapter 4 and summarize findings',
            'priority' => 'high',
            'status' => 'pending',
            'deadline' => '2026-08-15',
            'is_urgent' => '1',
        ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'user_id' => $user->id,
        'title' => 'Prepare clinical case review',
        'priority' => 'high',
        'status' => 'pending',
        'is_urgent' => true,
    ]);
});

test('user can update their own task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create([
        'title' => 'Old title',
        'priority' => 'low',
        'status' => 'pending',
        'is_urgent' => false,
    ]);

    $response = $this
        ->actingAs($user)
        ->patch(route('tasks.update', $task), [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'priority' => 'medium',
            'status' => 'in_progress',
            'deadline' => '2026-08-20',
        ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Updated title',
        'priority' => 'medium',
        'status' => 'in_progress',
        'is_urgent' => false,
    ]);
});

test('user can delete their own task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $response = $this
        ->actingAs($user)
        ->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $this->assertModelMissing($task);
});

test('user cannot access another users task', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $task = Task::factory()->for($owner)->create();

    $this->actingAs($intruder)->get(route('tasks.edit', $task))->assertNotFound();
    $this->actingAs($intruder)->patch(route('tasks.update', $task), [
        'title' => 'Hacked title',
        'description' => null,
        'priority' => 'low',
        'status' => 'pending',
        'deadline' => null,
    ])->assertNotFound();
    $this->actingAs($intruder)->delete(route('tasks.destroy', $task))->assertNotFound();
});

test('task validation fails on invalid payload', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('tasks.create'))
        ->post(route('tasks.store'), [
            'title' => '',
            'priority' => 'critical',
            'status' => 'waiting',
            'deadline' => 'invalid-date',
        ]);

    $response
        ->assertSessionHasErrors(['title', 'priority', 'status', 'deadline'])
        ->assertRedirect(route('tasks.create'));
});

test('user can filter tasks by status and priority', function () {
    $user = User::factory()->create();

    Task::factory()->for($user)->create([
        'title' => 'Pharmacology review',
        'status' => 'done',
        'priority' => 'high',
    ]);

    Task::factory()->for($user)->create([
        'title' => 'Anatomy notes',
        'status' => 'pending',
        'priority' => 'low',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('tasks.index', ['status' => 'done', 'priority' => 'high']));

    $response
        ->assertOk()
        ->assertSee('Pharmacology review')
        ->assertDontSee('Anatomy notes');
});
