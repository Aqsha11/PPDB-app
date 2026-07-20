<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Footer::first();

        return view('admin.footer.index', compact('data'));
    }

    public function update(Request $request)
    {
        $this->authorize('cms.manage');

        $validated = $request->validate([
            'deskripsi' => 'nullable',
            'copyright' => 'nullable',
            'alamat' => 'nullable',
            'email' => 'nullable|email',
            'telepon' => 'nullable',
            'logo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('footer', 'public');
        }

        Footer::updateOrCreate(['id' => 1], $validated);

        return back()->with('success', 'Footer berhasil diperbarui.');
    }
}
