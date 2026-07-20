<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function update(Request $request)
    {
        $this->authorize('cms.manage');

        $validated = $request->validate([
            'warna_primary' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'warna_second' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        ProfilSekolah::updateOrCreate(['id' => 1], $validated);

        return response()->json(['success' => true]);
    }
}
