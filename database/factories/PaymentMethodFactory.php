<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethods>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'number_max_installments' => fake()->numberBetween(1, 99),
            'show_on_store' => fake()->numberBetween(0, 1),
            'show_on_finance' => fake()->numberBetween(0, 1),
            'active' => 1,
        ];
    }
}
