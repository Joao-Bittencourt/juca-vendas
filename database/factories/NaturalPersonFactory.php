<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NaturalPerson>
 */
class NaturalPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer = Customer::factory()->create(['customer_type' => 'N']);
        $customerAge = fake()->numberBetween(10, 80);
        $birthDate = date('Y-m-d', strtotime("-{$customerAge} years"));

        return [
            'customer_id' => $customer->id,
            'cpf' => fake()->numerify('###########'),
            'birth_date' => $birthDate,
        ];
    }
}
