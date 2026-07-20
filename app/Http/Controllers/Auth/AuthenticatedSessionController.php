<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\PeriodePpdb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        $periodeAktif = PeriodePpdb::aktif()->first();

        return view('auth.login', compact('periodeAktif'));
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('Peserta')) {
            $periodeAktif = PeriodePpdb::aktif()->first();

            if (!$periodeAktif) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Pendaftaran sedang tidak dibuka. Silakan hubungi admin untuk informasi lebih lanjut.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('peserta.dashboard', absolute: false));
        }

        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
