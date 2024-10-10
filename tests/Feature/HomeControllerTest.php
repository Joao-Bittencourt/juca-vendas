<?php

test('access home page get request', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('home.index'));

    $response->assertViewIs('home');
    $response->assertStatus(200);
});
