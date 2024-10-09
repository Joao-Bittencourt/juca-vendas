<?php

namespace Tests\Feature\api;

use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use WithFaker;



    public function test_get_list_customers_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('api.customers.list') . '?q=' . $customer->name);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            $customer->name,
            $response->json()[0]['name']
        );
        $this->assertEquals(
            $customer->id,
            $response->json()[0]['id']
        );
    }
}
