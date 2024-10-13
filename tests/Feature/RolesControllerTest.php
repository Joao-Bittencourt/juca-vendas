<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesControllerTest extends TestCase
{
    use WithFaker;

    public function test_list_roles_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('roles.index'));

        $response->assertViewIs('role.index');
        $response->assertStatus(200);
    }

    public function test_create_roles_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('roles.create'));

        $response->assertViewIs('role.create');
        $response->assertStatus(200);
    }

    public function test_store_roles_post_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $name = $this->faker->sentence();
        $response = $this
            ->actingAs($loggedUser)
            ->post(route('roles.store'), [
                'name' => $name
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertStatus(302);

        $this->assertDatabaseHas('roles', ['name' => $name]);
    }

    public function test_edit_roles_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $name = $this->faker->sentence();
        $role = Role::create(['name' => $name]);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('roles.edit', ['role' => $role]));

        $response->assertViewIs('role.edit');
        $response->assertStatus(200);
    }

    public function test_update_roles_post_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $name = $this->faker->sentence();
        $role = Role::create(['name' => $name]);

        $response = $this
            ->actingAs($loggedUser)
            ->post(route('roles.update', ['role' => $role]), [
                'name' => $name . ' - updated'
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertStatus(302);

        $this->assertDatabaseHas('roles', ['name' => $name . ' - updated']);
    }

    public function test_add_permission_to_role_get_request_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $name = $this->faker->sentence();
        $role = Role::create(['name' => $name]);

        $response = $this
            ->actingAs($loggedUser)
            ->get(route('roles.add_permission_to_role', ['roleId' => $role->id]));

        $response->assertViewIs('role.add_permissions');
        $response->assertStatus(200);
    }

    public function test_give_permission_to_role_post_success(): void
    {
        $loggedUser =  $this->loggedUser;

        $name = $this->faker->sentence();
        $role = Role::create(['name' => $name]);

        $nameA = $this->faker->sentence();
        $nameB = $this->faker->sentence();

        $permissionA = $role->permissions()->create(['name' => $nameA]);
        $permissionB = $role->permissions()->create(['name' => $nameB]);

        $response = $this
            ->actingAs($loggedUser)
            ->post(route('roles.give_permission_to_role', ['roleId' => $role->id]), [
                'permission' => [$permissionA->name, $permissionB->name]
            ]);

        $response->assertRedirect(route('roles.index'));
        $response->assertStatus(302);
    }
}
