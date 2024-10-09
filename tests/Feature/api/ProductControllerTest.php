<?php

namespace Tests\Feature\api;

use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use WithFaker;



    public function test_get_list_products_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $product = Product::factory()->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('api.products.list') . '?q=' . $product->name);

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            $product->name,
            $response->json()[0]['name']
        );
        $this->assertEquals(
            $product->id,
            $response->json()[0]['id']
        );
    }
}
