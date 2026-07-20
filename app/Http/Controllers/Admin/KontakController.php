<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = PesanKontak::latest()->get();

        return view('admin.kontak.index', compact('data'));
    }

    public function show($id)
    {
        $this->authorize('cms.manage');

        $data = PesanKontak::findOrFail($id);
        $data->update(['is_read' => true]);

        return view('admin.kontak.show', compact('data'));
    }

    public function destroy($id)
    {
        $this->authorize('cms.manage');

        PesanKontak::findOrFail($id)->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
