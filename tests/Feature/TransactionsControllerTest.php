<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionsControllerTest extends TestCase
{
    use WithFaker;

    public function test_list_transactions_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('transactions.index'));

        $response->assertViewIs('transaction.index');
        $response->assertStatus(200);
    }

    public function test_create_transactions_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('transactions.create'));

        $response->assertViewIs('transaction.create');
        $response->assertStatus(200);
    }

    public function test_store_credit_transactions_post_success(): void
    {
        $transaction = Transaction::factory()->create(['type' => 'credit']);

        $transaction->installments = [
            [
                'amount' => number_format($transaction->amount, 2, '.', ''),
                'date' => $transaction->date,
            ]
        ];

        $transaction->installment_quantity = count($transaction->installments);

        $loggedUser =  $this->loggedUser;
        $response = $this
            ->actingAs($loggedUser)
            ->post(route('transactions.store'), $transaction->toArray());

        $response->assertRedirect(route('transactions.index'));
        $response->assertStatus(302);

        $this->assertDatabaseHas('transactions', [
            'identifier' => $transaction->identifier,
            'payment_method_id' => $transaction->payment_method_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'installment_number' => $transaction->installment_number,
            'date' => $transaction->date,
            'due_date' => $transaction->due_date,
            'paid_date' => $transaction->paid_date,
        ]);
    }

    public function test_store_debit_transactions_post_success(): void
    {
        $transaction = Transaction::factory()->create(['type' => 'debit']);

        $transaction->installments = [
            [
                'amount' => number_format($transaction->amount, 2, '.', ''),
                'date' => $transaction->date,
            ]
        ];

        $transaction->installment_quantity = count($transaction->installments);

        $loggedUser =  $this->loggedUser;
        $response = $this
            ->actingAs($loggedUser)
            ->post(route('transactions.store'), $transaction->toArray());

        $response->assertRedirect(route('transactions.index'));
        $response->assertStatus(302);

        $this->assertDatabaseHas('transactions', [
            'identifier' => $transaction->identifier,
            'payment_method_id' => $transaction->payment_method_id,
            'type' => $transaction->type,
            'amount' => $transaction->amount,
            'installment_number' => $transaction->installment_number,
            'date' => $transaction->date,
            'due_date' => $transaction->due_date,
            'paid_date' => $transaction->paid_date
        ]);
    }

    public function test_active_transactions_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $transaction = Transaction::factory()->create(['active' => 0]);
        $response = $this
            ->actingAs($loggedUser)
            ->get(route('transactions.active_deactive', ['transaction' => $transaction]));

        $response->assertRedirect(route('transactions.index'));
        $response->assertStatus(302);

        $transactionActive = Transaction::find($transaction->id);
        $this->assertEquals(1, $transactionActive->active);
    }

    public function test_deactive_transactions_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $transaction = Transaction::factory()->create(['active' => 1]);
        $response = $this
            ->actingAs($loggedUser)
            ->get(route('transactions.active_deactive', ['transaction' => $transaction]));

        $response->assertRedirect(route('transactions.index'));
        $response->assertStatus(302);

        $transactionActive = Transaction::find($transaction->id);
        $this->assertEquals(0, $transactionActive->active);
    }

    public function test_validate_transactions_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $paymentMethod = PaymentMethod::factory()->create();
        $paymentMethodId = $paymentMethod->id;
        $installmentQuantity = rand(1, $paymentMethod->number_max_installments);

        $date = date('Y-m-d');
        $response = $this
            ->actingAs($loggedUser)
            ->post(route('transactions.validate'), [
                'payment_method_id' => $paymentMethodId,
                'type' => 'debit',
                'amount' => '100.00',
                'date' => $date,
                'due_date' => $date,
                'paid_date' => $date,
                'installment_quantity' => $installmentQuantity,
                'installments.0.amount' => '100.00',
                'installments.0.date' => $date,
                'installments.0.due_date' => $date,
                'installments.0.paid_date' => $date,
            ]);

        $response->assertJson(['valid' => true]);
        $response->assertStatus(200);
    }

    public function test_validate_transactions_get_request_fail(): void
    {
        $loggedUser =  $this->loggedUser;

        $paymentMethod = PaymentMethod::factory()->create();

        $date = date('Y-m-d');
        $invalid = 'invalid';
        $response = $this
            ->actingAs($loggedUser)
            ->post(route('transactions.validate'), [
                'payment_method_id' => 1 . $invalid,
                'type' => 'debit' . $invalid,
                'amount' => '100.00' . $invalid,
                'date' => $date . $invalid,
                'due_date' => $date . $invalid,
                'paid_date' => $date . $invalid,
                'installment_quantity' => 1 . $invalid
            ])
            ->assertInvalid([
                'payment_method_id',
                'type',
                'amount',
                'date',
                'due_date',
                'paid_date',
                'installment_quantity',
            ]);
    }
}
