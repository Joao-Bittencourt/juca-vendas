<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(RoleRequest $request)
    {
        $request->validated();

        $role = new Role();
        $role->name = $request->name;

        $role->save();

        return redirect()
            ->route('roles.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Role $role)
    {
        return view('role.edit', [
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $request->validated();

        $role->name = $request->name;

        $role->save();

        return redirect()
            ->route('roles.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('role.add_permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()
            ->route('roles.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
