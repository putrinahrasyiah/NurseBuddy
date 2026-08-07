<?php

use App\Models\MoodEntry;
use App\Models\User;

test('guest cannot access mood tracker pages', function () {
    $this->get(route('moods.index'))->assertRedirect(route('login'));
    $this->get(route('moods.create'))->assertRedirect(route('login'));
    $this->post(route('moods.store'), [])->assertRedirect(route('login'));
});

test('user can create a mood entry', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(route('moods.store'), [
            'mood' => 'calm',
            'reflection' => 'Feeling focused after reviewing pharmacology notes.',
            'entry_date' => '2026-08-07',
        ]);

    $response->assertRedirect(route('moods.index'));

    $this->assertDatabaseHas('mood_entries', [
        'user_id' => $user->id,
        'mood' => 'calm',
        'entry_date' => '2026-08-07',
    ]);
});

test('user cannot create duplicate mood entry on the same date', function () {
    $user = User::factory()->create();

    MoodEntry::factory()->for($user)->create([
        'mood' => 'happy',
        'entry_date' => '2026-08-07',
    ]);

    $response = $this
        ->actingAs($user)
        ->from(route('moods.create'))
        ->post(route('moods.store'), [
            'mood' => 'sad',
            'reflection' => 'A long day at clinical practice.',
            'entry_date' => '2026-08-07',
        ]);

    $response
        ->assertSessionHasErrors(['entry_date'])
        ->assertRedirect(route('moods.create'));
});

test('user can update their own mood entry', function () {
    $user = User::factory()->create();
    $moodEntry = MoodEntry::factory()->for($user)->create([
        'mood' => 'tired',
        'reflection' => 'Old reflection',
        'entry_date' => '2026-08-06',
    ]);

    $response = $this
        ->actingAs($user)
        ->patch(route('moods.update', $moodEntry), [
            'mood' => 'calm',
            'reflection' => 'Recovered and focused now.',
            'entry_date' => '2026-08-06',
        ]);

    $response->assertRedirect(route('moods.index'));

    $this->assertDatabaseHas('mood_entries', [
        'id' => $moodEntry->id,
        'mood' => 'calm',
        'reflection' => 'Recovered and focused now.',
    ]);
});

test('user cannot access another users mood entry', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();

    $moodEntry = MoodEntry::factory()->for($owner)->create();

    $this->actingAs($intruder)->get(route('moods.edit', $moodEntry))->assertNotFound();
    $this->actingAs($intruder)->patch(route('moods.update', $moodEntry), [
        'mood' => 'happy',
        'reflection' => null,
        'entry_date' => '2026-08-07',
    ])->assertNotFound();
});

test('mood validation fails on invalid payload', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from(route('moods.create'))
        ->post(route('moods.store'), [
            'mood' => 'angry',
            'reflection' => str_repeat('x', 3000),
            'entry_date' => 'not-a-date',
        ]);

    $response
        ->assertSessionHasErrors(['mood', 'reflection', 'entry_date'])
        ->assertRedirect(route('moods.create'));
});

test('mood history only shows current users data and supports month filter', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    MoodEntry::factory()->for($user)->create([
        'mood' => 'happy',
        'entry_date' => '2026-08-03',
    ]);

    MoodEntry::factory()->for($user)->create([
        'mood' => 'sad',
        'entry_date' => '2026-07-29',
    ]);

    MoodEntry::factory()->for($otherUser)->create([
        'mood' => 'calm',
        'entry_date' => '2026-08-03',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('moods.index', ['month' => '2026-08']));

    $response
        ->assertOk()
        ->assertSee('Happy')
        ->assertDontSee('Sad');
});