<?php

use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\HasOne;

test('get customer type', function () {
    $customer = new Customer();

    expect($customer->getCustomerType('N'))->toEqual('Natural person');
    expect($customer->getCustomerType('J'))->toEqual('Juridical person');

    expect($customer->getCustomerType('X'))->toBeNull();
});

test('get customer types', function () {
    $customer = new Customer();

    expect($customer->getCustomerTypes())->toEqual([
        'N' => 'Natural person',
        'J' => 'Juridical person',
    ]);
});

test('customer has one natural person', function () {
    $customer = new Customer();

    expect($customer->natural_person())->toBeInstanceOf(HasOne::class);
});

test('customer has one juridical person', function () {
    $customer = new Customer();
    expect($customer->juridical_person())->toBeInstanceOf(HasOne::class);
});

test('customer get actions', function () {
    $customer = (new Customer())->factory()->create();
    expect($customer->getActions())->toBeArray();
});
