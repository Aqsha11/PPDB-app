<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('role.view');
        $data = Role::with('permissions')->latest()->get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('role.create');
        $permissions = Permission::all()->groupBy(function ($p) {
            return explode('.', $p->name)[0];
        });
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('role.create');
        $request->validate(['name' => 'required|unique:roles,name']);
        $role = Role::create(['name' => $request->name]);
        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.role.index')->with('success', 'Role berhasil dibuat.');
    }

    public function show(Role $role)
    {
        $this->authorize('role.view');
        $role->load('permissions');
        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $this->authorize('role.edit');
        $permissions = Permission::all()->groupBy(function ($p) {
            return explode('.', $p->name)[0];
        });
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('role.edit');
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update(['name' => $request->name]);
        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diupdate.');
    }

    public function destroy(Role $role)
    {
        $this->authorize('role.delete');
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus.');
    }
}
