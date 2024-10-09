<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentMethodsControllerTest extends TestCase
{
    use WithFaker;



    public function test_list_payment_methods_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('payment-methods.index'));

        $response->assertViewIs('payment-method.index');
        $response->assertStatus(200);
    }

    public function test_create_payment_methods_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('payment-methods.create'));

        $response->assertViewIs('payment-method.create');
        $response->assertStatus(200);
    }

    public function test_store_payment_methods_post_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $this->actingAs($loggedUser);

        $name = $this->faker->word;
        $numberMaxInstallments = $this->faker->numberBetween(1, 99);
        $showOnStore = $this->faker->numberBetween(0, 1);
        $showOnFinance = $this->faker->numberBetween(0, 1);
        $active = $this->faker->numberBetween(0, 1);


        $response = $this->post(route('payment-methods.store'), [
            'name' => $name,
            'number_max_installments' => $numberMaxInstallments,
            'show_on_store' => $showOnStore,
            'show_on_finance' => $showOnFinance,
        ]);

        $response->assertRedirect(route('payment-methods.index'));
        $response->assertStatus(302);
    }

    public function test_edit_payment_methods_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;
        $paymentMethod = PaymentMethod::factory()->create();

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('payment-methods.edit', ['paymentMethod' => $paymentMethod]));

        $response->assertViewIs('payment-method.edit');
        $response->assertStatus(200);
    }

    public function test_update_payment_methods_post_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $paymentMethod = PaymentMethod::factory()->create();

        $this->actingAs($loggedUser);

        $name = $this->faker->word;
        $numberMaxInstallments = $this->faker->numberBetween(1, 99);
        $showOnStore = $this->faker->numberBetween(0, 1);
        $showOnFinance = $this->faker->numberBetween(0, 1);

        $response = $this->post(route('payment-methods.update', ['paymentMethod' => $paymentMethod]), [
            'name' => $name,
            'number_max_installments' => $numberMaxInstallments,
            'show_on_store' => $showOnStore,
            'show_on_finance' => $showOnFinance,
        ]);

        $response->assertRedirect(route('payment-methods.index'));
        $response->assertStatus(302);
    }

    public function test_active_payment_methods_get_success(): void
    {

        $loggedUser =  $this->loggedUser;
        $this->actingAs($loggedUser);
        $paymentMethod = PaymentMethod::factory()->create(['active' => 0]);

        $response = $this
            ->get(route('payment-methods.active_deactive', ['paymentMethod' => $paymentMethod]));

        $response->assertRedirect(route('payment-methods.index'));
        $response->assertStatus(302);

        $paymentMethodActive = PaymentMethod::find($paymentMethod->id);
        $this->assertEquals(1, $paymentMethodActive->active);
    }
}
