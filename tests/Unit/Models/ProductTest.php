<?php

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('product belongs to brand', function () {
    $product = new Product();
    expect($product->brand())->toBeInstanceOf(BelongsTo::class);
});

test('find list products', function () {
    $randomItem = fake()->numberBetween(1, 100);

    $product = new Product();
    expect($product->findListProducts($randomItem))->toHaveCount(0);

    $productTest = Product::factory()->create(['name' => $randomItem ]);
    expect($productTest->findListProducts($randomItem))->toHaveCount(1);
});

test('product get actions', function () {
    $product = (new Product())->factory()->create();
    expect($product->getActions())->toBeArray();
});
