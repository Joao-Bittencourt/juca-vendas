<?php

use App\Models\NaturalPerson;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('natural person belongs to customer', function () {
    $naturalPerson = new NaturalPerson();
    expect($naturalPerson->customer())->toBeInstanceOf(BelongsTo::class);
});

test('natural person get actions', function () {
    $naturalPerson = (new NaturalPerson())->factory()->create();
    expect($naturalPerson->getActions())->toBeArray();
});
