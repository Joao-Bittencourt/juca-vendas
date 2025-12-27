<?php

declare(strict_types=1);

use App\Models\PaymentMethod;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('list payment methods get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('payment-methods.index'));

    $response->assertViewIs('payment-method.index');
    $response->assertStatus(200);
});

test('create payment methods get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('payment-methods.create'));

    $response->assertViewIs('payment-method.create');
    $response->assertStatus(200);
});

test('store payment methods post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $name = $this->faker->word;
    $numberMaxInstallments = $this->faker->numberBetween(1, 99);
    $showOnStore = $this->faker->numberBetween(0, 1);
    $showOnFinance = $this->faker->numberBetween(0, 1);
    $active = $this->faker->numberBetween(0, 1);

    $response = $this->post(route('payment-methods.store'), [
        'name' => $name,
        'number_max_installments' => $numberMaxInstallments,
        'show_on_store' => $showOnStore,
        'show_on_finance' => $showOnFinance,
    ]);

    $response->assertRedirect(route('payment-methods.index'));
    $response->assertStatus(302);
});

test('edit payment methods get request success', function () {
    $loggedUser =  $this->loggedUser;
    $paymentMethod = PaymentMethod::factory()->create();

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('payment-methods.edit', ['paymentMethod' => $paymentMethod]));

    $response->assertViewIs('payment-method.edit');
    $response->assertStatus(200);
});

test('update payment methods post success', function () {
    $loggedUser =  $this->loggedUser;
    $paymentMethod = PaymentMethod::factory()->create();

    $this->actingAs($loggedUser);

    $name = $this->faker->word;
    $numberMaxInstallments = $this->faker->numberBetween(1, 99);
    $showOnStore = $this->faker->numberBetween(0, 1);
    $showOnFinance = $this->faker->numberBetween(0, 1);

    $response = $this->post(route('payment-methods.update', ['paymentMethod' => $paymentMethod]), [
        'name' => $name,
        'number_max_installments' => $numberMaxInstallments,
        'show_on_store' => $showOnStore,
        'show_on_finance' => $showOnFinance,
    ]);

    $response->assertRedirect(route('payment-methods.index'));
    $response->assertStatus(302);
});

test('active payment methods get success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);
    $paymentMethod = PaymentMethod::factory()->create(['active' => 0]);

    $response = $this
        ->get(route('payment-methods.active_deactive', ['paymentMethod' => $paymentMethod]));

    $response->assertRedirect(route('payment-methods.index'));
    $response->assertStatus(302);

    $paymentMethodActive = PaymentMethod::find($paymentMethod->id);
    expect($paymentMethodActive->active)->toEqual(1);
});
