<?php

use App\Models\PaymentMethod;
use App\Models\Transaction;

uses(\Illuminate\Foundation\Testing\WithFaker::class);

test('list transactions get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('transactions.index'));

    $response->assertViewIs('transaction.index');
    $response->assertStatus(200);
});

test('create transactions get request success', function () {
    $response = $this
        ->actingAs($this->loggedUser)
        ->get(route('transactions.create'));

    $response->assertViewIs('transaction.create');
    $response->assertStatus(200);
});

test('store credit transactions post success', function () {
    $transaction = Transaction::factory()->create(['type' => 'credit']);
    $transaction->installment_quantity = 1;
    $transaction->installments = [
        [
            'amount' => number_format($transaction->amount, 2, '.', ''),
            'date' => $transaction->date
        ]
    ];

    $response = $this
        ->actingAs($this->loggedUser)
        ->post(route('transactions.store'), $transaction->toArray());

    $response->assertRedirect(route('transactions.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('transactions', [
        'identifier' => $transaction->identifier,
        'payment_method_id' => $transaction->payment_method_id,
        'type' => $transaction->type,
        'amount' => $transaction->amount,
        'installment_number' => $transaction->installment_number,
        'date' => $transaction->date,
        'due_date' => $transaction->due_date,
        'paid_date' => $transaction->paid_date,
    ]);
});

test('store debit transactions post success', function () {
    $transaction = Transaction::factory()->create(['type' => 'debit']);
    $transaction->installment_quantity = 1;

    $transaction->installments = [
        [
            'amount' => number_format($transaction->amount, 2, '.', ''),
            'date' => $transaction->date
        ]
    ];

    $loggedUser =  $this->loggedUser;
    $response = $this
        ->actingAs($loggedUser)
        ->post(route('transactions.store'), $transaction->toArray());

    $response->assertRedirect(route('transactions.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('transactions', [
        'identifier' => $transaction->identifier,
        'payment_method_id' => $transaction->payment_method_id,
        'type' => $transaction->type,
        'amount' => $transaction->amount,
        'installment_number' => $transaction->installment_number,
        'date' => $transaction->date,
        'due_date' => $transaction->due_date,
        'paid_date' => $transaction->paid_date,
    ]);
});

test('active transactions get request success', function () {
    $loggedUser =  $this->loggedUser;

    $transaction = Transaction::factory()->create(['active' => 0]);
    $response = $this
        ->actingAs($loggedUser)
        ->get(route('transactions.active_deactive', ['transaction' => $transaction]));

    $response->assertRedirect(route('transactions.index'));
    $response->assertStatus(302);

    $transactionActive = Transaction::find($transaction->id);
    expect($transactionActive->active)->toEqual(1);
});

test('deactive transactions get request success', function () {
    $loggedUser =  $this->loggedUser;

    $transaction = Transaction::factory()->create(['active' => 1]);
    $response = $this
        ->actingAs($loggedUser)
        ->get(route('transactions.active_deactive', ['transaction' => $transaction]));

    $response->assertRedirect(route('transactions.index'));
    $response->assertStatus(302);

    $transactionActive = Transaction::find($transaction->id);
    expect($transactionActive->active)->toEqual(0);
});

test('validate transactions get request success', function () {
    $loggedUser =  $this->loggedUser;

    $paymentMethod = PaymentMethod::factory()->create();
    $paymentMethodId = $paymentMethod->id;
    $installmentQuantity = rand(1, $paymentMethod->number_max_installments);

    $date = date('Y-m-d');
    $response = $this
        ->actingAs($loggedUser)
        ->post(route('transactions.validate'), [
            'payment_method_id' => $paymentMethodId,
            'type' => 'debit',
            'amount' => '100.00',
            'date' => $date,
            'due_date' => $date,
            'paid_date' => $date,
            'installment_quantity' => $installmentQuantity,
            'installments.0.amount' => '100.00',
            'installments.0.date' => $date,
            'installments.0.due_date' => $date,
            'installments.0.paid_date' => $date,
        ]);

    $response->assertJson(['valid' => true]);
    $response->assertStatus(200);
});

test('validate transactions get request fail', function () {
    $loggedUser =  $this->loggedUser;

    $paymentMethod = PaymentMethod::factory()->create();

    $date = date('Y-m-d');
    $invalid = 'invalid';
    $response = $this
        ->actingAs($loggedUser)
        ->post(route('transactions.validate'), [
            'payment_method_id' => 1 . $invalid,
            'type' => 'debit' . $invalid,
            'amount' => '100.00' . $invalid,
            'date' => $date . $invalid,
            'due_date' => $date . $invalid,
            'paid_date' => $date . $invalid,
            'installment_quantity' => 1 . $invalid
        ])
        ->assertInvalid([
            'payment_method_id',
            'type',
            'amount',
            'date',
            'due_date',
            'paid_date',
            'installment_quantity',
        ]);
});
