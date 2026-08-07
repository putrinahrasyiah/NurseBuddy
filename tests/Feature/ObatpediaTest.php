<?php

use App\Models\Drug;
use App\Models\DrugVote;
use App\Models\User;

test('guest cannot access obatpedia pages', function () {
    $drug = Drug::factory()->create();

    $this->get(route('obatpedia.index'))->assertRedirect(route('login'));
    $this->get(route('obatpedia.show', $drug))->assertRedirect(route('login'));
    $this->patch(route('obatpedia.vote', $drug), [
        'vote' => 'up',
    ])->assertRedirect(route('login'));
});

test('user can browse and search drugs including aliases', function () {
    $user = User::factory()->create();

    $match = Drug::factory()->create([
        'name' => 'Paracetamol',
        'generic_name' => 'Acetaminophen',
    ]);
    $match->aliases()->create(['alias' => 'PCM']);

    $skip = Drug::factory()->create([
        'name' => 'Cefixime',
        'generic_name' => 'Cefixime',
    ]);
    $skip->aliases()->create(['alias' => 'CFX']);

    $this->actingAs($user)
        ->get(route('obatpedia.index', ['search' => 'PCM']))
        ->assertOk()
        ->assertSee('Paracetamol')
        ->assertDontSee('Cefixime');
});

test('user can view drug details', function () {
    $user = User::factory()->create();
    $drug = Drug::factory()->create([
        'name' => 'Ibuprofen',
        'indication' => 'Pain and inflammation.',
    ]);

    $this->actingAs($user)
        ->get(route('obatpedia.show', $drug))
        ->assertOk()
        ->assertSee('Ibuprofen')
        ->assertSee('Pain and inflammation.');
});

test('user can upvote and toggle vote', function () {
    $user = User::factory()->create();
    $drug = Drug::factory()->create();

    $this->actingAs($user)
        ->patch(route('obatpedia.vote', $drug), ['vote' => 'up'])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $this->assertDatabaseHas('drug_votes', [
        'user_id' => $user->id,
        'drug_id' => $drug->id,
        'vote' => DrugVote::VOTE_UP,
    ]);

    $this->actingAs($user)
        ->patch(route('obatpedia.vote', $drug), ['vote' => 'up'])
        ->assertSessionHasNoErrors()
        ->assertRedirect();

    $this->assertDatabaseMissing('drug_votes', [
        'user_id' => $user->id,
        'drug_id' => $drug->id,
    ]);
});

test('vote change only affects current user', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $drug = Drug::factory()->create();

    DrugVote::factory()->for($userB)->for($drug)->create([
        'vote' => DrugVote::VOTE_DOWN,
    ]);

    $this->actingAs($userA)
        ->patch(route('obatpedia.vote', $drug), ['vote' => 'up'])
        ->assertRedirect();

    $this->assertDatabaseHas('drug_votes', [
        'user_id' => $userA->id,
        'drug_id' => $drug->id,
        'vote' => DrugVote::VOTE_UP,
    ]);

    $this->assertDatabaseHas('drug_votes', [
        'user_id' => $userB->id,
        'drug_id' => $drug->id,
        'vote' => DrugVote::VOTE_DOWN,
    ]);
});
