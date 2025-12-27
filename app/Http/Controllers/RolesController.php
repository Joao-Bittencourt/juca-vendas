<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RolesController extends Controller
{
    public function index(): View
    {
        return view('role.index', [
            'roles' => Role::paginate(Controller::DEFAULT_PAGE_SIZE)
        ]);
    }

    public function create(): View
    {
        return view('role.create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $request->validated();

        $role = new Role();
        $role->name = $request->name;

        $role->save();

        return redirect()
            ->route('roles.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Role $role): View
    {
        return view('role.edit', [
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $request->validated();

        $role->name = $request->name;

        $role->save();

        return redirect()
            ->route('roles.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function addPermissionToRole(string|int $roleId): View
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

    public function givePermissionToRole(Request $request, string|int $roleId): RedirectResponse
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
