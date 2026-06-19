<x-layouts.public :title="$data->judul">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="{{ route('public.pengumuman.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-8 font-medium">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Pengumuman
        </a>
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 sm:p-12">
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $data->created_at->format('d F Y') }}
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">{{ $data->judul }}</h1>
                <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($data->isi)) !!}
                </div>
                @if($data->lampiran)
                    <div class="mt-10 pt-8 border-t border-gray-100">
                        <a href="{{ Storage::url($data->lampiran) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-5 py-3 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition font-medium">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Lampiran
                        </a>
                    </div>
                @endif
            </div>
        </article>
    </div>
</x-layouts.public>
