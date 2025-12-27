<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $brand = Brand::inRandomOrder()->first() ?: Brand::factory()->create();

        return [
            'brand_id' => $brand->id,
            'name' => fake()->name(),
            'description' => fake()->text(150),
            'cod_product' => fake()->regexify('[A-Za-z0-9]{4}'),
            'price' => fake()->numberBetween(1, 100) . '.' . fake()->randomNumber(2, true),
            'active' => 1,
        ];
    }
}
