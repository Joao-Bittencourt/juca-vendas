<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;

uses(\Illuminate\Foundation\Testing\WithFaker::class);

test('list sales get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('sales.index'));

    $response->assertViewIs('sale.index');
    $response->assertStatus(200);
});

test('view sales get request success', function () {
    $loggedUser =  $this->loggedUser;
    $sale = Sale::factory()->create()->fresh();

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('sales.view', ['sale' => $sale]));

    $response->assertViewIs('sale.view');
    $response->assertStatus(200);
});

test('create sales get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('sales.create'));

    $response->assertViewIs('sale.create');
    $response->assertStatus(200);
});

test('store sales post success', function () {
    $loggedUser =  $this->loggedUser;

    $product = Product::factory()->create();
    $productId = $product->id;
    $productPrice = $product->price;
    $quantity = $this->faker->numberBetween(1, 10);
    $total = $productPrice * $quantity;
    $productOne = [
        'product_id' => $productId,
        'product_price' => $productPrice,
        'price' => $productPrice,
        'quantity' => $quantity,
        'total' => $total
    ];

    $productTwo = [
        'product_id' => $productId,
        'product_price' => $productPrice * 2,
        'price' => $productPrice * 2,
        'quantity' => $quantity * 2,
        'total' => $total * 2
    ];

    $saleTotal = $productOne['total'] + $productTwo['total'];

    $response = $this
        ->actingAs($loggedUser)
        ->post(route('sales.store'), [
            'customer_id' => Customer::where('customer_type', 'N')->first()->id,
            'salesman_id' => $loggedUser->id,
            'total' => $saleTotal,
            'date' => $this->faker->date(),
            'situation' => $this->faker->numberBetween(0, 3),
            'saleItem' => [
                1 => $productOne,
                2 => $productTwo
            ],
            'payment_method_id' => 1,
            'type' => 'credit',
            'installment_quantity' => 1,
            'installments' => [
                [
                    'amount' => number_format($saleTotal, 2, '.', ''),
                ]
            ]
        ]);

    $response->assertRedirect(route('sales.index'));
    $response->assertStatus(302);
});

test('sale validate post success', function () {
    $loggedUser =  $this->loggedUser;

    $product = Product::factory()->create();
    $productId = $product->id;
    $productPrice = $product->price;
    $quantity = $this->faker->numberBetween(1, 10);
    $total = $productPrice * $quantity;
    $productOne = [
        'product_id' => $productId,
        'product_price' => $productPrice,
        'price' => $productPrice,
        'quantity' => $quantity,
        'total' => $total
    ];

    $productTwo = [
        'product_id' => $productId,
        'product_price' => $productPrice * 2,
        'price' => $productPrice * 2,
        'quantity' => $quantity * 2,
        'total' => $total * 2
    ];

    $saleTotal = $productOne['total'] + $productTwo['total'];

    $response = $this
        ->actingAs($loggedUser)
        ->post(route('sales.validate'), [
            'customer_id' => Customer::where('customer_type', 'N')->first()->id,
            'salesman_id' => $loggedUser->id,
            'total' => $saleTotal,
            'date' => $this->faker->date(),
            'situation' => $this->faker->numberBetween(0, 3),
            'saleItem' => [
                1 => $productOne,
                2 => $productTwo
            ],
            'payment_method_id' => 1,
            'type' => 'credit',
            'installment_quantity' => 1,
            'installments' => [
                [
                    'amount' => number_format($saleTotal, 2, '.', ''),
                ]
            ]
        ]);

    $response->assertJson(['valid' => true]);
    $response->assertStatus(200);
});
