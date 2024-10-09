<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_access_home_page_get_request(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('home.index'));

        $response->assertViewIs('home');
        $response->assertStatus(200);

    }
}
