<?php

use App\Models\Place;
use App\Models\User;

test('create a review', function () {
    $user = User::factory()->create();
    $place = Place::factory()->create();

    $response = $this->actingAs($user)->post(route('reviews.store'), [
        'rating' => 5,
        'comment' => 'Great place!',
        'place_id' => $place->id,
        'user_id' => $user->id,
    ]);
    $this->assertDatabaseHas('reviews', [
        'user_id' => $user->id,
        'place_id' => $place->id,
        'rating' => 5,
        'comment' => 'Great place!',
    ]);
});

test('validate review creation', function () {
    $user = User::factory()->create();
    $place = Place::factory()->create();

    $response = $this->actingAs($user)->post(route('reviews.store'), [
        'rating' => 6, // Invalid rating
        'comment' => 'Great place!',
        'place_id' => $place->id,
        'user_id' => $user->id,
    ]);

    $response->assertSessionHasErrors(['rating']);
});

test('update a review', function () {
    $user = User::factory()->create();
    $place = Place::factory()->create();
    $review = $user->reviews()->create([
        'rating' => 4,
        'comment' => 'Good place',
        'place_id' => $place->id,
        'user_id' => $user->id,
        'created_by' => $user->id,
    ]);

    $this->actingAs($user)->put(route('reviews.update', $review), [
        'place_id' => $place->id,
        'user_id' => $user->id,
        'rating' => 5,
        'comment' => 'Great place!',
    ]);

    $this->assertDatabaseHas('reviews', [
        'id' => $review->id,
        'rating' => 5,
        'comment' => 'Great place!',
    ]);
});

test('delete a review', function () {
    $user = User::factory()->create();
    $place = Place::factory()->create();
    $review = $user->reviews()->create([
        'rating' => 4,
        'comment' => 'Good place',
        'place_id' => $place->id,
        'user_id' => $user->id,
        'created_by' => $user->id,
    ]);

    $this->actingAs($user)->delete(route('reviews.destroy', $review));

    $this->assertSoftDeleted('reviews', ['id' => $review->id]);
});
