<?php

declare(strict_types=1);

use App\Models\Role;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('list roles get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('roles.index'));

    $response->assertViewIs('role.index');
    $response->assertStatus(200);
});

test('create roles get request success', function () {
    $loggedUser =  $this->loggedUser;

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('roles.create'));

    $response->assertViewIs('role.create');
    $response->assertStatus(200);
});

test('store roles post success', function () {
    $loggedUser =  $this->loggedUser;

    $name = $this->faker->word;
    $response = $this
        ->actingAs($loggedUser)
        ->post(route('roles.store'), [
            'name' => $name
        ]);

    $response->assertRedirect(route('roles.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('roles', ['name' => $name]);
});

test('edit roles get request success', function () {
    $loggedUser =  $this->loggedUser;

    $name = $this->faker->word;
    $role = Role::create(['name' => $name]);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('roles.edit', ['role' => $role]));

    $response->assertViewIs('role.edit');
    $response->assertStatus(200);
});

test('update roles post success', function () {
    $loggedUser =  $this->loggedUser;

    $name = $this->faker->word;
    $role = Role::create(['name' => $name]);

    $response = $this
        ->actingAs($loggedUser)
        ->post(route('roles.update', ['role' => $role]), [
            'name' => $name . ' - updated'
        ]);

    $response->assertRedirect(route('roles.index'));
    $response->assertStatus(302);

    $this->assertDatabaseHas('roles', ['name' => $name . ' - updated']);
});

test('add permission to role get request success', function () {
    $loggedUser =  $this->loggedUser;

    $name = $this->faker->word;
    $role = Role::create(['name' => $name]);

    $response = $this
        ->actingAs($loggedUser)
        ->get(route('roles.add_permission_to_role', ['roleId' => $role->id]));

    $response->assertViewIs('role.add_permissions');
    $response->assertStatus(200);
});

test('give permission to role post success', function () {
    $loggedUser =  $this->loggedUser;

    $name = $this->faker->word;
    $role = Role::create(['name' => $name]);

    $nameA = $this->faker->word;
    $nameB = $this->faker->word;

    $permissionA = $role->permissions()->create(['name' => $nameA]);
    $permissionB = $role->permissions()->create(['name' => $nameB]);

    $response = $this
        ->actingAs($loggedUser)
        ->post(route('roles.give_permission_to_role', ['roleId' => $role->id]), [
            'permission' => [$permissionA->name, $permissionB->name]
        ]);

    $response->assertRedirect(route('roles.index'));
    $response->assertStatus(302);
});
