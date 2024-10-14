<?php

namespace Tests\Unit\Models;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    public function test_payment_method_get_actions()
    {
        $paymentMethod = (new PaymentMethod())->factory()->create();
        $this->assertIsArray($paymentMethod->getActions());
    }

    public function test_max_installments()
    {
        $this->assertEquals(99, PaymentMethod::MAX_INSTALLMENTS);
    }
}
