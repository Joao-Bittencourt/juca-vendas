<?php

namespace Tests\Unit\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function test_transaction_belongs_to_payment_method(): void
    {
        $transaction = new Transaction();
        $this->assertInstanceOf(
            BelongsTo::class,
            $transaction->paymentMethod()
        );
    }

    public function test_transaction_belongs_to_sale(): void
    {
        $transaction = new Transaction();
        $this->assertInstanceOf(
            BelongsTo::class,
            $transaction->sale()
        );
    }
}
