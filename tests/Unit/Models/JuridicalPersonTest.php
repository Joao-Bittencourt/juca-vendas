<?php

declare(strict_types=1);

use App\Models\JuridicalPerson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('juridical person belongs to customer', function () {
    $juridicalPerson = new JuridicalPerson();
    expect($juridicalPerson->customer())->toBeInstanceOf(BelongsTo::class);
});

test('juridical person get actions', function () {
    $juridicalPerson = (new JuridicalPerson())->factory()->create();
    expect($juridicalPerson->getActions())->toBeArray();
});
