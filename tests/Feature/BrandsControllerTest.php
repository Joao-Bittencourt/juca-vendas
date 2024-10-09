<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandsControllerTest extends TestCase
{
    use WithFaker;



    public function test_list_brands_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('brands.index'));

        $response->assertViewIs('brand.index');
        $response->assertStatus(200);
    }

    public function test_create_brands_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('brands.create'));

        $response->assertViewIs('brand.create');
        $response->assertStatus(200);
    }

    public function test_store_brands_post_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $this->actingAs($loggedUser);

        $name = $this->faker->word;

        $response = $this->post(route('brands.store'), [
            'name' => $name
        ]);

        $response->assertRedirect(route('brands.index'));
        $response->assertStatus(302);
    }

    public function test_edit_brands_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $brand = Brand::factory()->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('brands.edit', ['brand' => $brand]));

        $response->assertViewIs('brand.edit');
        $response->assertStatus(200);
    }

    public function test_update_brands_post_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $brand = Brand::factory()->create();

        $this->actingAs($loggedUser);

        $name = $this->faker->word;
        $response = $this->post(route('brands.update', ['brand' => $brand]), [
            'name' => $name
        ]);

        $response->assertRedirect(route('brands.index'));
        $response->assertStatus(302);
    }

    public function test_active_brands_get_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $this->actingAs($loggedUser);
        $brand = Brand::factory()->create(['active' => 0]);

        $response = $this
            ->get(route('brands.active_deactive', ['brand' => $brand]));

        $response->assertRedirect(route('brands.index'));
        $response->assertStatus(302);

        $brandActive = Brand::find($brand->id);
        $this->assertEquals(1, $brandActive->active);
    }
}
