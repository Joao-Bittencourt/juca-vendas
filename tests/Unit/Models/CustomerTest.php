<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    public function test_get_customer_type(): void
    {
        $customer = new Customer();

        $this->assertEquals('Natural person', $customer->getCustomerType('N'));
        $this->assertEquals('Juridical person', $customer->getCustomerType('J'));

        $this->assertNull($customer->getCustomerType('X'));
    }

    public function test_get_customer_types(): void
    {
        $customer = new Customer();

        $this->assertEquals([
            'N' => 'Natural person',
            'J' => 'Juridical person',
        ], $customer->getCustomerTypes());
    }

    public function test_customer_has_one_natural_person(): void
    {
        $customer = new Customer();

        $this->assertInstanceOf(
            HasOne::class,
            $customer->natural_person()
        );
    }

    public function test_customer_has_one_juridical_person(): void
    {
        $customer = new Customer();
        $this->assertInstanceOf(
            HasOne::class,
            $customer->juridical_person()
        );
    }

    public function test_customer_get_actions(): void
    {
        $customer = (new Customer())->factory()->create();
        $this->assertIsArray($customer->getActions());
    }
}
