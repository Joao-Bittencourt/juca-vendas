<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JuridicalPerson>
 */
class JuridicalPersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customer = Customer::factory()->create(['customer_type' => 'J']);

        return [
            'customer_id' => $customer->id,
            'corporate_name' => fake()->company(),
            'cnpj' => fake()->numerify('##############'),
        ];
    }
}
