<?php

use App\Models\Brand;

uses(\Illuminate\Foundation\Testing\WithFaker::class);

test('list brands get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('brands.index'));

    $response->assertViewIs('brand.index');
    $response->assertStatus(200);
});

test('create brands get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('brands.create'));

    $response->assertViewIs('brand.create');
    $response->assertStatus(200);
});

test('store brands post success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);

    $name = $this->faker->word;

    $response = $this->post(route('brands.store'), [
        'name' => $name
    ]);

    $response->assertRedirect(route('brands.index'));
    $response->assertStatus(302);
});

test('edit brands get request success', function () {
    $loggedUser =  $this->loggedUser;
    $brand = Brand::factory()->create();

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('brands.edit', ['brand' => $brand]));

    $response->assertViewIs('brand.edit');
    $response->assertStatus(200);
});

test('update brands post success', function () {
    $loggedUser =  $this->loggedUser;
    $brand = Brand::factory()->create();

    $this->actingAs($loggedUser);

    $name = $this->faker->word;
    $response = $this->post(route('brands.update', ['brand' => $brand]), [
        'name' => $name
    ]);

    $response->assertRedirect(route('brands.index'));
    $response->assertStatus(302);
});

test('active brands get success', function () {
    $loggedUser =  $this->loggedUser;
    $this->actingAs($loggedUser);
    $brand = Brand::factory()->create(['active' => 0]);

    $response = $this
        ->get(route('brands.active_deactive', ['brand' => $brand]));

    $response->assertRedirect(route('brands.index'));
    $response->assertStatus(302);

    $brandActive = Brand::find($brand->id);
    expect($brandActive->active)->toEqual(1);
});