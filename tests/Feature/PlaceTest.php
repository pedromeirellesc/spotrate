<?php

use App\Models\Place;
use App\Models\User;

describe('get places tests', function () {
    it('should return successfully status code', function () {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->get('/places');

        $response->assertStatus(200);
    });
});

describe('get places create tests', function () {
    it('should return successfully status code', function () {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->get('/places/create');

        $response->assertStatus(200);
    });
});

describe('post places create', function () {
    it('post as admin should create a place successfully', function () {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->post('/places', [
            'name' => 'Test Place',
            'description' => 'This is a test place.',
            'location' => 'Test Location',
            'address' => '123 Test St',
        ]);

        $response->assertRedirect('/places');
        $this->assertDatabaseHas('places', ['name' => 'Test Place', 'created_by' => $user->id]);
    });

    it('post with empty fields should return validation errors', function () {
        $user = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user);

        $response = $this->post('/places', [
            'name' => '',
            'address' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'address']);
    });
});

describe('get places edit', function () {
    it('get as admin should return successfully status code', function () {
        $user = User::factory()->create(['role' => 'admin']);
        $place = Place::factory()->create();

        $this->actingAs($user);

        $response = $this->get("/places/edit/{$place->id}");

        $response->assertStatus(200);
    });
});

describe('put places update', function () {
    it('put place as a admin should update successfully', function () {
        $user = User::factory()->create(['role' => 'admin']);
        $place = Place::factory()->create();

        $this->actingAs($user);

        $response = $this->put("/places/{$place->id}", [
            'name' => 'Updated Place',
            'description' => 'This is an updated place.',
            'location' => 'Updated Location',
            'address' => '456 Updated St',
        ]);

        $response->assertRedirect('/places');
        $this->assertDatabaseHas('places', ['name' => 'Updated Place', 'updated_by' => $user->id]);
    });

    it('put as non-admin user or non-creator should return forbidden status code', function () {
        $user = User::factory()->create(['role' => 'user']);
        $place = Place::factory()->create(['created_by' => User::factory()->create()->id]);

        $this->actingAs($user);

        $response = $this->put("/places/{$place->id}", [
            'name' => 'Unauthorized Update',
            'description' => 'This update should not be allowed.',
            'address' => 'Unauthorized Address',
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('places', ['name' => 'Unauthorized Update']);
    });
});

describe('delete place', function () {
    it('delete as admin should delete successfully', function () {
        $user = User::factory()->create(['role' => 'admin']);
        $place = Place::factory()->create();

        $this->actingAs($user);

        $response = $this->delete("/places/{$place->id}");

        $response->assertRedirect('/places');

        $this->assertSoftDeleted('places', ['id' => $place->id]);
    });
    it('delete as non-admin or non-creator user should return forbidden status code', function () {
        $user = User::factory()->create(['role' => 'user']);
        $place = Place::factory()->create(['created_by' => User::factory()->create()->id]);

        $this->actingAs($user);

        $response = $this->delete("/places/{$place->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('places', ['id' => $place->id]);
    });
});
