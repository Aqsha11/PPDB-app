<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PeriodePpdb;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $periodeAktif = PeriodePpdb::aktif()->first();

        return view('auth.register', compact('periodeAktif'));
    }

    public function store(Request $request): RedirectResponse
    {
        $periodeAktif = PeriodePpdb::aktif()->first();

        if (!$periodeAktif) {
            return back()->withErrors([
                'email' => 'Pendaftaran sedang tidak dibuka. Tidak ada periode PPDB yang aktif saat ini.',
            ])->onlyInput('email');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 'confirmed', 'min:8',
                'regex:/[A-Z]/',
                'regex:/@/',
                'regex:/[0-9]/',
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Peserta');

        event(new Registered($user));

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }
}
