<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleItemFactory extends Factory
{
    public function definition(): array
    {
        $product = \App\Models\Product::all()->random();
        $productPrice = $product->price;
        $quantity = fake()->numberBetween(1, 10);
        $total = $productPrice * $quantity;

        return [
            'sale_id' => \App\Models\Sale::all()->random()->id,
            'product_id' => $product->id,
            'product_price' => $productPrice,
            'price' => $productPrice,
            'quantity' => $quantity,
            'total' => $total,
        ];
    }
}
