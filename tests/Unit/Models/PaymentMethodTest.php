<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\PaymentMethod;

test('payment method get actions', function () {
    $paymentMethod = PaymentMethod::factory()->create();
    expect($paymentMethod->getActions())->toBeArray();
});

test('payment method max installments', function () {
    expect(PaymentMethod::MAX_INSTALLMENTS)->toBe(99);
});
