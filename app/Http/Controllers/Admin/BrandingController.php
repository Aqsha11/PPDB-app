<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class BrandingController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = ProfilSekolah::firstOrCreate(['id' => 1], ['nama_sekolah' => 'PPDB']);

        return view('admin.branding.index', compact('data'));
    }

    public function update(Request $request)
    {
        $this->authorize('cms.manage');

        $validated = $request->validate([
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:512',
        ]);

        $data = ProfilSekolah::firstOrCreate(['id' => 1], ['nama_sekolah' => 'PPDB']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('branding', 'public');
        }

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('branding', 'public');
        }

        $data->update($validated);

        return back()->with('success', 'Branding berhasil diperbarui.');
    }
}
