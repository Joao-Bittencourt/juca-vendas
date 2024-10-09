<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use WithFaker;



    public function test_list_products_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('products.index'));

        $response->assertViewIs('product.index');
        $response->assertStatus(200);
    }

    public function test_create_products_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('products.create'));

        $response->assertViewIs('product.create');
        $response->assertStatus(200);
    }

    public function test_store_products_post_success(): void
    {
        $brand = Brand::factory()->create();

        $loggedUser =  $this->loggedUser;
        $this->actingAs($loggedUser);

        $name = $this->faker->word;
        $codProduct = $this->faker->regexify('[A-Za-z0-9]{4}');
        $description = $this->faker->word;
        $price = fake()->numberBetween(1, 300) . '.' . fake()->randomNumber(2, true);

        $response = $this->post(route('products.store'), [
            'name' => $name,
            'cod_product' => $codProduct,
            'description' => $description,
            'price' => $price,
            'brand_id' => $brand->id
        ]);

        $response->assertRedirect(route('products.index'));
        $response->assertStatus(302);
    }

    public function test_edit_products_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $product = Product::factory()->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('products.edit', ['product' => $product]));

        $response->assertViewIs('product.edit');
        $response->assertStatus(200);
    }

    public function test_update_products_post_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $product = Product::factory()->create();
        $brand = Brand::factory()->create();

        $this->actingAs($loggedUser);

        $name = $this->faker->word;
        $codProduct = $this->faker->regexify('[A-Za-z0-9]{4}');
        $description = $this->faker->word;
        $price = fake()->numberBetween(1, 100) . '.' . fake()->randomNumber(2, true);

        $response = $this->post(route('products.update', ['product' => $product]), [
            'name' => $name,
            'cod_product' => $codProduct,
            'description' => $description,
            'price' => $price,
            'brand_id' => $brand->id
        ]);

        $response->assertRedirect(route('products.index'));
        $response->assertStatus(302);
    }

    public function test_deactive_products_get_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $product = Product::factory()->create();
        $this->actingAs($loggedUser);

        $response = $this
            ->get(route('products.active_deactive', ['product' => $product]));


        $response->assertRedirect(route('products.index'));
        $response->assertStatus(302);

        $productDeactive = Product::find($product->id);
        $this->assertEquals(0, $productDeactive->active);
    }

    public function test_active_products_get_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $product = Product::factory()->create(['active' => 0]);
        $this->actingAs($loggedUser);

        $response = $this
            ->get(route('products.active_deactive', ['product' => $product]));

        $response->assertRedirect(route('products.index'));
        $response->assertStatus(302);

        $producActive = Product::find($product->id);
        $this->assertEquals(1, $producActive->active);
    }
}
