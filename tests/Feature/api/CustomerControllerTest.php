<?php

declare(strict_types=1);

use App\Models\Customer;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('get list customers success', function () {
    $loggedUser =  $this->loggedUser;

    $customer = Customer::factory()->create();

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('api.customers.list') . '?q=' . $customer->name);

    expect($response->status())->toEqual(200);
    expect($response->json()[0]['name'])->toEqual($customer->name);
    expect($response->json()[0]['id'])->toEqual($customer->id);
});
