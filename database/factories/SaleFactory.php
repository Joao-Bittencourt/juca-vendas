<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Customer::all()->random()->id,
            'salesman_id' => \App\Models\User::all()->random()->id,
            'total' => fake()->randomFloat(2, 0, 1000),
            'date' => fake()->date(),
            // 0 = Cancelado, 1 = Em aberto, 2 = Pendente, 3 = Concluído,
            'situation' => fake()->numberBetween(0, 3),
        ];
    }
}
