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
        $adminRoles = ['Super Admin', 'Admin', 'Operator', 'Verifikator'];
        $admin = User::with('roles')->whereHas('roles', fn($q) => $q->whereIn('name', $adminRoles))->latest()->paginate(20);
        $peserta = User::with('roles')->whereHas('roles', fn($q) => $q->where('name', 'Peserta'))->latest()->paginate(20);
        return view('admin.user.index', compact('admin', 'peserta'));
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
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->syncRoles($request->roles);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dibuat.');
    }

    public function show(User $user)
    {
        $this->authorize('user.view');
        $user->load('roles', 'peserta');
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

        if ($request->roles) {
            $request->validate(['roles.*' => 'exists:roles,name']);
            $user->syncRoles($request->roles);
        }

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate.');
    }

    public function toggleStatus(User $user)
    {
        $this->authorize('user.edit');
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil {$status}.");
    }

    public function verifyEmail(User $user)
    {
        $this->authorize('user.edit');
        if ($user->hasVerifiedEmail()) {
            return back()->with('warning', 'Email pengguna sudah terverifikasi.');
        }
        $user->markEmailAsVerified();
        return back()->with('success', 'Email pengguna berhasil diverifikasi.');
    }

    public function sendVerification(User $user)
    {
        $this->authorize('user.edit');
        if ($user->hasVerifiedEmail()) {
            return back()->with('warning', 'Email pengguna sudah terverifikasi.');
        }
        $user->sendEmailVerificationNotification();
        return back()->with('success', 'Email verifikasi telah dikirim ulang.');
    }

    public function destroy(User $user)
    {
        $this->authorize('user.delete');
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
