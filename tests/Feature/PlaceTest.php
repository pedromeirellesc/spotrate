<?php

use App\Models\Place;
use App\Models\User;

test('get places', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user);

    $response = $this->get('/places');

    $response->assertStatus(200);
});

test('get create place', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user);

    $response = $this->get('/places/create');

    $response->assertStatus(200);
});

test('create place as a admin', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user);

    $response = $this->post('/places', [
        'name' => 'Test Place',
        'description' => 'This is a test place.',
        'location' => 'Test Location',
        'address' => '123 Test St',
        'city' => 'Test City',
        'state' => 'Test State',
        'country' => 'Test Country',
    ]);

    $response->assertRedirect('/places');
    $this->assertDatabaseHas('places', ['name' => 'Test Place', 'created_by' => $user->id]);
});

test('get edit place as a admin', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $place = Place::factory()->create();

    $this->actingAs($user);

    $response = $this->get("/places/edit/{$place->id}");

    $response->assertStatus(200);
});

test('update place as a admin', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $place = Place::factory()->create();

    $this->actingAs($user);

    $response = $this->put("/places/{$place->id}", [
        'name' => 'Updated Place',
        'description' => 'This is an updated place.',
        'location' => 'Updated Location',
        'address' => '456 Updated St',
        'city' => 'Updated City',
        'state' => 'Updated State',
        'country' => 'Updated Country',
    ]);

    $response->assertRedirect('/places');
    $this->assertDatabaseHas('places', ['name' => 'Updated Place', 'updated_by' => $user->id]);
}); 

test('delete place as a admin', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $place = Place::factory()->create();

    $this->actingAs($user);

    $response = $this->delete("/places/{$place->id}");

    $response->assertRedirect('/places');

    $this->assertSoftDeleted('places', ['id' => $place->id]);
}); 

test('non-admin user or non-creator cannot update a place', function () {
    $user = User::factory()->create(['role' => 'user']);
    $place = Place::factory()->create(['created_by' => User::factory()->create()->id]);

    $this->actingAs($user);

    $response = $this->put("/places/{$place->id}", [
        'name' => 'Unauthorized Update',
        'description' => 'This update should not be allowed.',
        'address' => 'Unauthorized Address',
        'city' => 'Unauthorized City',
        'state' => 'Unauthorized State',
        'country' => 'Unauthorized Country',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseMissing('places', ['name' => 'Unauthorized Update']);
});

test('non-admin user or non-creator cannot delete a place', function () {
    $user = User::factory()->create(['role' => 'user']);
    $place = Place::factory()->create(['created_by' => User::factory()->create()->id]);

    $this->actingAs($user);

    $response = $this->delete("/places/{$place->id}");

    $response->assertForbidden();
    $this->assertDatabaseHas('places', ['id' => $place->id]);
});

test('validation errors when creating a place', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $this->actingAs($user);

    $response = $this->post('/places', [
        'name' => '',
        'address' => '',
        'city' => '',
        'state' => '',
        'country' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'address', 'city', 'state', 'country']);
});