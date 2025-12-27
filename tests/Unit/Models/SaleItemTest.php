<?php

declare(strict_types=1);

use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('sale item belongs to product', function () {
    $saleItem = new SaleItem();
    expect($saleItem->product())->toBeInstanceOf(BelongsTo::class);
});

test('sale item belongs to sale', function () {
    $saleItem = new SaleItem();
    expect($saleItem->sale())->toBeInstanceOf(BelongsTo::class);
});
