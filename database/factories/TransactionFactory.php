<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $paymentMethod = PaymentMethod::inRandomOrder()->first() ?? PaymentMethod::factory()->create();
        $sale = Sale::inRandomOrder()->first() ?? Sale::factory()->create();

        $paymentMethodNumberMaxInstallments = $paymentMethod->number_max_installments;
        return [
            'identifier' => fake()->uuid(),
            'payment_method_id' => $paymentMethod->id,
            'sale_id' => $sale->id,
            'type' => fake()->randomElement(['credit', 'debit']),
            'amount' => number_format(fake()->randomFloat(2, 1, 1000), 2, '.', ''),
            'installment_number' => $paymentMethodNumberMaxInstallments,
            'date' => fake()->date(),
            'due_date' => fake()->date(),
            'paid_date' => fake()->date(),
            'active' => 1,
        ];
    }
}
