<?php

use App\Models\User;

test('guests can view the home page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('authenticated users can visit the home', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/');
    $response->assertStatus(200);
});
