<x-app-layout>
    <x-slot name="header">Pengumuman</x-slot>

    <div class="space-y-4" x-data="{ expanded: null }">
        @forelse($data as $pengumuman)
            <x-card>
                <div class="cursor-pointer" @click="expanded = expanded === {{ $loop->index }} ? null : {{ $loop->index }}">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-semibold text-gray-900">{{ $pengumuman->judul }}</h3>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $pengumuman->tanggal ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') : ($pengumuman->created_at ? $pengumuman->created_at->format('d F Y') : '-') }}</span>
                            <svg class="h-4 w-4 transition-transform" :class="expanded === {{ $loop->index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-600" x-show="expanded !== {{ $loop->index }}">
                        {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 200) }}
                    </div>
                    <div class="mt-2 text-sm text-gray-700" x-show="expanded === {{ $loop->index }}" x-cloak>
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                </div>
            </x-card>
        @empty
            <x-card>
                <div class="text-center py-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    <p class="mt-4 text-gray-500">Belum ada pengumuman.</p>
                </div>
            </x-card>
        @endforelse
    </div>
</x-app-layout>
