<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomersControllerTest extends TestCase
{
    use WithFaker;



    public function test_list_customers_get_request(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.index'));

        $response->assertViewIs('customer.index');
        $response->assertStatus(200);
    }

    public function test_create_customers_get_request(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.create'));

        $response->assertViewIs('customer.create');
        $response->assertStatus(200);
    }

    public function test_store_customers_natural_person_post_success(): void
    {
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
    }

    public function test_store_customers_juridical_person_post_success(): void
    {
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
    }

    public function test_edit_customers_natural_person_get_request(): void
    {
        $loggedUser =  $this->loggedUser;
        $customer = Customer::factory()->create(['customer_type' => 'N']);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.edit', ['customer' => $customer]));

        $response->assertViewIs('customer.edit');
        $response->assertStatus(200);
    }

    public function test_edit_customers_juridical_person_get_request(): void
    {
        $loggedUser =  $this->loggedUser;
        $customer = Customer::factory()->create(['customer_type' => 'J']);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.edit', ['customer' => $customer]));

        $response->assertViewIs('customer.edit');
        $response->assertStatus(200);
    }

    public function test_update_customers_natural_person_post_success(): void
    {
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
    }

    public function test_update_customers_juridical_person_post_success(): void
    {
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
    }

    public function test_active_customers_get_request(): void
    {
        $loggedUser =  $this->loggedUser;
        $customer = Customer::factory()->create(['active' => 0]);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.active_deactive', ['customer' => $customer]));

        $response->assertRedirect(route('customers.index'));
        $response->assertStatus(302);

        $customerActive = Customer::find($customer->id);
        $this->assertEquals(1, $customerActive->active);
    }

    public function test_deactive_customers_get_request(): void
    {
        $loggedUser =  $this->loggedUser;
        $customer = Customer::factory()->create(['active' => 1]);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('customers.active_deactive', ['customer' => $customer]));

        $response->assertRedirect(route('customers.index'));
        $response->assertStatus(302);

        $customerActive = Customer::find($customer->id);
        $this->assertEquals(0, $customerActive->active);
    }
}
