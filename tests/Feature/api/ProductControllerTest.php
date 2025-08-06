<?php

use App\Models\Product;

uses(\Illuminate\Foundation\Testing\WithFaker::class);

test('get list products success', function () {
    $loggedUser =  $this->loggedUser;

    $product = Product::factory()->create();

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('api.products.list') . '?q=' . $product->name);

    expect($response->status())->toEqual(200);
    expect($response->json()[0]['name'])->toEqual($product->name);
    expect($response->json()[0]['id'])->toEqual($product->id);
});
