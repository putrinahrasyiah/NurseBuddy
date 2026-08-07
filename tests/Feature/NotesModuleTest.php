<?php

use App\Models\Note;
use App\Models\User;

test('guest cannot access notes pages', function () {
    $this->get(route('notes.index'))->assertRedirect(route('login'));
    $this->get(route('notes.create'))->assertRedirect(route('login'));
    $this->post(route('notes.store'), [])->assertRedirect(route('login'));
});

test('user can create a note', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('notes.store'), [
            'title' => 'Fluid and Electrolyte Summary',
            'content' => 'Review signs of dehydration and nursing interventions.',
            'tags' => 'nursing,fluid-balance',
            'is_pinned' => '1',
        ]);

    $response->assertRedirect(route('notes.index'));

    $this->assertDatabaseHas('notes', [
        'user_id' => $user->id,
        'title' => 'Fluid and Electrolyte Summary',
        'is_pinned' => true,
    ]);
});

test('user can update their own note', function () {
    $user = User::factory()->create();
    $note = Note::factory()->for($user)->create([
        'title' => 'Old title',
        'is_pinned' => false,
    ]);

    $response = $this
        ->actingAs($user)
        ->patch(route('notes.update', $note), [
            'title' => 'Updated title',
            'content' => 'Updated content for exam preparation.',
            'tags' => 'exam,summary',
            'is_pinned' => '1',
        ]);

    $response->assertRedirect(route('notes.index'));

    $this->assertDatabaseHas('notes', [
        'id' => $note->id,
        'title' => 'Updated title',
        'is_pinned' => true,
    ]);
});

test('user can delete their own note', function () {
    $user = User::factory()->create();
    $note = Note::factory()->for($user)->create();

    $response = $this
        ->actingAs($user)
        ->delete(route('notes.destroy', $note));

    $response->assertRedirect(route('notes.index'));
    $this->assertModelMissing($note);
});

test('user cannot access another users note', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $note = Note::factory()->for($owner)->create();

    $this->actingAs($intruder)->get(route('notes.edit', $note))->assertNotFound();
    $this->actingAs($intruder)->patch(route('notes.update', $note), [
        'title' => 'Hacked title',
        'content' => 'hacked',
        'tags' => null,
    ])->assertNotFound();
    $this->actingAs($intruder)->delete(route('notes.destroy', $note))->assertNotFound();
    $this->actingAs($intruder)->patch(route('notes.pin', $note))->assertNotFound();
});

test('notes validation fails on invalid payload', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('notes.create'))
        ->post(route('notes.store'), [
            'title' => '',
            'content' => '',
            'tags' => str_repeat('x', 260),
        ]);

    $response
        ->assertSessionHasErrors(['title', 'content', 'tags'])
        ->assertRedirect(route('notes.create'));
});

test('search only returns current users matching notes', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Note::factory()->for($user)->create([
        'title' => 'Pharmacology Chapter 1',
        'content' => 'Drug classifications and safety checks.',
    ]);

    Note::factory()->for($user)->create([
        'title' => 'Anatomy Practice',
        'content' => 'Musculoskeletal flashcards.',
    ]);

    Note::factory()->for($otherUser)->create([
        'title' => 'Pharmacology private',
        'content' => 'Should not be visible.',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('notes.index', ['q' => 'Pharmacology']));

    $response
        ->assertOk()
        ->assertSee('Pharmacology Chapter 1')
        ->assertDontSee('Anatomy Practice')
        ->assertDontSee('Pharmacology private');
});

test('user can pin and unpin own note', function () {
    $user = User::factory()->create();
    $note = Note::factory()->for($user)->create([
        'is_pinned' => false,
    ]);

    $this->actingAs($user)
        ->patch(route('notes.pin', $note))
        ->assertRedirect(route('notes.index'));

    $this->assertDatabaseHas('notes', [
        'id' => $note->id,
        'is_pinned' => true,
    ]);

    $this->actingAs($user)
        ->patch(route('notes.pin', $note))
        ->assertRedirect(route('notes.index'));

    $this->assertDatabaseHas('notes', [
        'id' => $note->id,
        'is_pinned' => false,
    ]);
});
