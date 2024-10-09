<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function test_product_belongs_to_brand(): void
    {
        $product = new Product();
        $this->assertInstanceOf(
            BelongsTo::class,
            $product->brand()
        );
    }

    public function test_find_list_products(): void
    {
        $randomItem = fake()->numberBetween(1, 100);

        $product = new Product();
        $this->assertCount(0, $product->findListProducts($randomItem));

        $productTest = Product::factory()->create(['name' => $randomItem ]);
        $this->assertCount(1, $productTest->findListProducts($randomItem));
    }

    public function test_product_get_actions(): void
    {
        $product = (new Product())->factory()->create();
        $this->assertIsArray($product->getActions());
    }
}
