<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use Illuminate\Http\Request;

class MediaSosialController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = MediaSosial::orderBy('urutan')->get();

        return view('admin.media-sosial.index', compact('data'));
    }

    public function update(Request $request, MediaSosial $mediaSosial)
    {
        $this->authorize('cms.manage');

        $mediaSosial->update($request->validate([
            'url' => 'required|url',
        ]));

        return back()->with('success', 'URL media sosial berhasil diperbarui.');
    }

    public function toggleStatus(MediaSosial $mediaSosial)
    {
        $this->authorize('cms.manage');

        $mediaSosial->update(['status' => !$mediaSosial->status]);

        return back()->with('success', 'Status media sosial berhasil diperbarui.');
    }
}
