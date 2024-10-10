<?php

use App\Models\Customer;

uses(\Illuminate\Foundation\Testing\WithFaker::class);

test('list customers get request', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.index'));

    $response->assertViewIs('customer.index');
    $response->assertStatus(200);
});

test('create customers get request', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.create'));

    $response->assertViewIs('customer.create');
    $response->assertStatus(200);
});

test('store customers natural person post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $name = $this->faker->word;
    $email = $this->faker->email;
    $customerType = 'N';
    $cpf = $this->faker->numerify('###########');
    $birthDate = $this->faker->date();

    $response = $this->post(route('customers.store'), [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'cpf' => $cpf,
        'birth_date' => $birthDate
    ]);

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('customers', [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'active' => 1 // on create it is active
    ]);

    $this->assertDatabaseHas('natural_people', [
        'cpf' => $cpf,
        'birth_date' => $birthDate,
    ]);
});

test('store customers juridical person post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $name = $this->faker->word;
    $email = $this->faker->email;
    $customerType = 'J';
    $cnpj = $this->faker->numerify('##############');

    $response = $this->post(route('customers.store'), [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'cnpj' => $cnpj
    ]);

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('customers', [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'active' => 1 // on create it is active
    ]);

    $this->assertDatabaseHas('juridical_people', [
        'cnpj' => $cnpj,
    ]);
});

test('edit customers natural person get request', function () {
    $loggedUser =  $this->loggedUser;
    $customer = Customer::factory()->create(['customer_type' => 'N']);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.edit', ['customer' => $customer]));

    $response->assertViewIs('customer.edit');
    $response->assertStatus(200);
});

test('edit customers juridical person get request', function () {
    $loggedUser =  $this->loggedUser;
    $customer = Customer::factory()->create(['customer_type' => 'J']);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.edit', ['customer' => $customer]));

    $response->assertViewIs('customer.edit');
    $response->assertStatus(200);
});

test('update customers natural person post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $customer = Customer::factory()->create();

    $name = $this->faker->word;
    $email = $this->faker->email;
    $customerType = 'N';
    $cpf = $this->faker->numerify('###########');
    $birthDate = $this->faker->date();

    $response = $this->post(route('customers.update', ['customer' => $customer]), [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'cpf' => $cpf,
        'birth_date' => $birthDate
    ]);

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('customers', [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
    ]);

    // @todo: test natural people
    // $this->assertDatabaseHas('natural_people', [
    //     'cpf' => $cpf,
    //     'birth_date' => $birthDate,
    // ]);
});

test('update customers juridical person post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $customer = Customer::factory()->create();

    $name = $this->faker->word;
    $email = $this->faker->email;
    $customerType = 'J';
    $cnpj = $this->faker->numerify('##############');

    $response = $this->post(route('customers.update', ['customer' => $customer]), [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
        'cnpj' => $cnpj,
    ]);

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('customers', [
        'name' => $name,
        'email' => $email,
        'customer_type' => $customerType,
    ]);

    // @todo: test juridical people
    // $this->assertDatabaseHas('juridical_people', [
    //     'cnpj' => $cnpj,
    // ]);
});

test('active customers get request', function () {
    $loggedUser =  $this->loggedUser;
    $customer = Customer::factory()->create(['active' => 0]);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.active_deactive', ['customer' => $customer]));

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $customerActive = Customer::find($customer->id);
    expect($customerActive->active)->toEqual(1);
});

test('deactive customers get request', function () {
    $loggedUser =  $this->loggedUser;
    $customer = Customer::factory()->create(['active' => 1]);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('customers.active_deactive', ['customer' => $customer]));

    $response->assertRedirect(route('customers.index'));
    $response->assertStatus(302);

    $customerActive = Customer::find($customer->id);
    expect($customerActive->active)->toEqual(0);
});