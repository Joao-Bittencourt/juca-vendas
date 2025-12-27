<?php

declare(strict_types=1);

use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('brand has many products', function () {
    $brand = new Brand();
    expect($brand->product())->toBeInstanceOf(HasMany::class);
});

test('brand get actions', function () {
    $brand = (new Brand())->factory()->create();
    expect($brand->getActions())->toBeArray();
});
