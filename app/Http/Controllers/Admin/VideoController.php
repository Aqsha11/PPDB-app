<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Video::all();

        return view('admin.video.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.video.create');
    }

    public function show(Video $video)
    {
        $this->authorize('cms.manage');

        $data = $video;

        return view('admin.video.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        Video::create(
            $request->validate([
                'judul' => 'required',
                'youtube_url' => 'required',
            ])
        );

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil dibuat.');
    }

    public function edit(Video $video)
    {
        $this->authorize('cms.manage');

        $data = $video;

        return view('admin.video.edit', compact('data'));
    }

    public function update(Request $request, Video $video)
    {
        $this->authorize('cms.manage');

        $video->update(
            $request->validate([
                'judul' => 'required',
                'youtube_url' => 'required',
            ])
        );

        return redirect()->route('admin.video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function toggleStatus(Video $video)
    {
        $this->authorize('cms.manage');

        $video->update(['status' => !$video->status]);

        return back()->with('success', 'Status video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $this->authorize('cms.manage');

        $video->delete();

        return back()->with('success', 'Video berhasil dihapus.');
    }
}
