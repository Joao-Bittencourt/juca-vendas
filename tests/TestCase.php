<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->seed(RoleSeeder::class);
        $this->seed(PermissionSeeder::class);

        $this->loggedUser = User::factory()->create()->assignRole('super_admin');
    }
}
