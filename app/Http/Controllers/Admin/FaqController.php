<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Faq::orderBy('urutan')->get();

        return view('admin.faq.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.faq.create');
    }

    public function show(Faq $faq)
    {
        $this->authorize('cms.manage');

        $data = $faq;

        return view('admin.faq.show', compact('data'));
    }

    public function edit(Faq $faq)
    {
        $this->authorize('cms.manage');

        $data = $faq;

        return view('admin.faq.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        Faq::create(
            $request->validate([
                'pertanyaan' => 'required',
                'jawaban' => 'required',
                'urutan' => 'nullable|integer',
            ])
        );

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dibuat.');
    }

    public function update(Request $request, Faq $faq)
    {
        $this->authorize('cms.manage');

        $faq->update(
            $request->validate([
                'pertanyaan' => 'required',
                'jawaban' => 'required',
                'urutan' => 'nullable|integer',
            ])
        );

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function toggleStatus(Faq $faq)
    {
        $this->authorize('cms.manage');

        $faq->update(['status' => !$faq->status]);

        return back()->with('success', 'Status FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $this->authorize('cms.manage');

        $faq->delete();

        return back()->with('success', 'FAQ berhasil dihapus.');
    }
}
