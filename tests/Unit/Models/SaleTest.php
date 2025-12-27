<?php

declare(strict_types=1);

use App\Models\Sale;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('sale belongs to customer', function () {
    $sale = new Sale();
    expect($sale->customer())->toBeInstanceOf(BelongsTo::class);
});

test('sale belongs to salesman', function () {
    $sale = new Sale();
    expect($sale->salesman())->toBeInstanceOf(BelongsTo::class);
});

test('sale has many sale items', function () {
    $sale = new Sale();
    expect($sale->saleItems())->toBeInstanceOf(HasMany::class);
});

test('sale get actions', function () {
    $sale = (new Sale())->factory()->create();
    expect($sale->getActions())->toBeArray();
});
