<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Database\Seeders\InitSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $loggedUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->seed(InitSeeder::class);
        // $this->seed(RoleSeeder::class);
        // $this->seed(PermissionSeeder::class);

        $this->loggedUser = User::factory()->create()->assignRole('super_admin');
    }
}
