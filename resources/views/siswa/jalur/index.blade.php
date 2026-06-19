<x-app-layout>
    <x-slot name="header">Pilih Jalur Pendaftaran</x-slot>

    <div class="space-y-6">
        @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($pendaftaran)
            <x-card title="Pilihan Saat Ini">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-lg text-gray-900">{{ $pendaftaran->jalur?->nama ?? '-' }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $pendaftaran->jalur?->deskripsi ?? '' }}</p>
                    </div>
                    <x-badge color="{{ $pendaftaran->status === 'submitted' ? 'blue' : 'yellow' }}">
                        {{ $pendaftaran->status === 'submitted' ? 'Telah Dikirim' : 'Dipilih' }}
                    </x-badge>
                </div>
            </x-card>

            @if($pendaftaran->status !== 'draft')
                <x-card>
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="mt-4 text-gray-600 font-medium">Pendaftaran telah dikirimkan</p>
                        <p class="text-sm text-gray-500 mt-1">Jalur pendaftaran tidak dapat diubah karena pendaftaran sudah diproses.</p>
                    </div>
                </x-card>
            @endif
        @endif

        @if(!$pendaftaran || $pendaftaran->status === 'draft')
            <form method="POST" action="{{ route('siswa.jalur.store') }}" x-data="{ selected: '{{ $pendaftaran?->jalur_id ?? '' }}' }">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($jalur as $j)
                        <div @click="selected = '{{ $j->id }}'"
                             class="cursor-pointer rounded-xl border-2 p-5 transition"
                             :class="selected === '{{ $j->id }}' ? 'border-indigo-500 bg-indigo-50' : 'border-gray-200 bg-white hover:border-gray-300'">
                            <div class="flex items-start justify-between">
                                <h4 class="font-semibold text-gray-900">{{ $j->nama }}</h4>
                                <input type="radio" name="jalur_id" value="{{ $j->id }}" x-model="selected" class="sr-only">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Kuota: {{ $j->kuota }} siswa</p>
                            @if($j->deskripsi)
                                <p class="text-sm text-gray-600 mt-2">{{ $j->deskripsi }}</p>
                            @endif
                            @if($j->persyaratan)
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs font-medium text-gray-500 mb-1">Persyaratan:</p>
                                    <p class="text-xs text-gray-600">{!! nl2br(e($j->persyaratan)) !!}</p>
                                </div>
                            @endif
                            <div class="mt-4">
                                <button type="submit" @click="selected = '{{ $j->id }}'" class="w-full text-center px-4 py-2 text-sm font-medium rounded-lg transition"
                                    :class="selected === '{{ $j->id }}' ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'">
                                    Pilih Jalur Ini
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <x-empty-state title="Belum ada jalur pendaftaran" description="Belum ada jalur pendaftaran tersedia saat ini." />
                        </div>
                    @endforelse
                </div>
            </form>
        @endif
    </div>
</x-app-layout>
