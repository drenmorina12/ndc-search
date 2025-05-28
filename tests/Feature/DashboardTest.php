<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get('/home');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the home', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/home');
    $response->assertStatus(200);
});