<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('role.view');
        $permissions = Permission::all()->groupBy(function ($p) {
            $parts = explode('.', $p->name);
            return $parts[0];
        });
        $roles = Role::all();
        return view('admin.permission.index', compact('permissions', 'roles'));
    }

    public function create()
    {
        $this->authorize('role.create');
        $roles = Role::all();
        return view('admin.permission.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('role.create');
        $data = $request->validate([
            'name' => 'required|unique:permissions,name|regex:/^[a-zA-Z0-9._-]+$/',
            'display_name' => 'nullable|string|max:255',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $permission = Permission::create(['name' => $data['name']]);

        $permission->description = $data['display_name'] ?? null;

        if ($request->filled('roles')) {
            foreach ($request->roles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if ($role && !$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil dibuat.');
    }

    public function edit(Permission $permission)
    {
        $this->authorize('role.edit');
        $roles = Role::all();
        $roleNames = Role::join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->where('role_has_permissions.permission_id', $permission->id)
            ->pluck('roles.name')
            ->toArray();
        return view('admin.permission.edit', compact('permission', 'roles', 'roleNames'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('role.edit');
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9._-]+$/|unique:permissions,name,' . $permission->id,
            'display_name' => 'nullable|string|max:255',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $permission->name = $request->name;
        $permission->save();

        $permission->description = $request->display_name;

        if ($request->has('roles')) {
            $allRoles = Role::all()->pluck('name');
            foreach ($allRoles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if (in_array($roleName, $request->roles)) {
                    if (!$role->hasPermissionTo($permission)) {
                        $role->givePermissionTo($permission);
                    }
                } else {
                    if ($role->hasPermissionTo($permission)) {
                        $role->revokePermissionTo($permission);
                    }
                }
            }
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil diubah.');
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('role.delete');

        $corePermissions = [
            'dashboard.view',
            'user.view', 'user.create', 'user.edit', 'user.delete',
            'role.view', 'role.create', 'role.edit', 'role.delete',
        ];
        if (in_array($permission->name, $corePermissions)) {
            return back()->with('error', 'Tidak dapat menghapus permission inti sistem.');
        }

        $permission->delete();
        return back()->with('success', 'Permission berhasil dihapus.');
    }
}
