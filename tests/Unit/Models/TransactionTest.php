<?php

declare(strict_types=1);

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('transaction belongs to payment method', function () {
    $transaction = new Transaction();
    expect($transaction->paymentMethod())->toBeInstanceOf(BelongsTo::class);
});

test('transaction belongs to sale', function () {
    $transaction = new Transaction();
    expect($transaction->sale())->toBeInstanceOf(BelongsTo::class);
});
