<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user.view');
        $data = User::with('roles')->latest()->paginate(20);
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('user.create');
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('user.create');
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole($data['role']);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dibuat.');
    }

    public function show(User $user)
    {
        $this->authorize('user.view');
        $user->load('roles', 'siswa');
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('user.edit');
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('user.edit');
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->role) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $this->authorize('user.delete');
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
