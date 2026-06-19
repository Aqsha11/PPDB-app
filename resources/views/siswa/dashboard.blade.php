<x-app-layout>
    <x-slot name="header">Dashboard Siswa</x-slot>

    @php
        $steps = [
            ['label' => 'Isi Biodata', 'route' => 'siswa.biodata.edit', 'done' => $siswa && $siswa->nama_lengkap],
            ['label' => 'Pilih Jalur', 'route' => 'siswa.jalur.index', 'done' => $pendaftaran && $pendaftaran->jalur_id],
            ['label' => 'Upload Dokumen', 'route' => 'siswa.dokumen.index', 'done' => $dokumen && $dokumen->count() > 0],
            ['label' => 'Submit Pendaftaran', 'route' => null, 'done' => $pendaftaran && $pendaftaran->status !== 'draft'],
            ['label' => 'Verifikasi', 'route' => null, 'done' => $pendaftaran && in_array($pendaftaran->status, ['verifikasi', 'diterima', 'ditolak'])],
            ['label' => 'Hasil Seleksi', 'route' => null, 'done' => $pendaftaran && in_array($pendaftaran->status, ['diterima', 'ditolak'])],
            ['label' => 'Daftar Ulang', 'route' => 'siswa.daftar-ulang.index', 'done' => $pendaftaran && $pendaftaran->status === 'diterima'],
        ];
        $currentStep = 1;
        foreach ($steps as $i => $step) {
            if (!$step['done']) { $currentStep = $i + 1; break; }
            $currentStep = $i + 2;
        }
    @endphp

    <div class="space-y-6">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-6 text-white">
            <h2 class="text-2xl font-bold">Selamat Datang, {{ $siswa?->nama_lengkap ?? auth()->user()->name }}!</h2>
            <p class="mt-1 text-blue-100">Kelola pendaftaran PPDB Anda di sini.</p>
        </div>

        @if(!$pendaftaran)
            <x-card title="Mulai Pendaftaran">
                <div class="text-center py-6">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Anda belum mendaftar</h3>
                    <p class="mt-1 text-sm text-gray-500">Silakan lengkapi biodata dan pilih jalur pendaftaran untuk memulai.</p>
                    <a href="{{ route('siswa.jalur.index') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Mulai Pendaftaran</a>
                </div>
            </x-card>
        @else
            <x-card title="Status Pendaftaran">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm mb-4">
                    <div>
                        <span class="text-gray-500">No. Pendaftaran</span>
                        <p class="font-medium">{{ $pendaftaran->no_pendaftaran ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Jalur</span>
                        <p class="font-medium">{{ $pendaftaran->jalur?->nama ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Status</span>
                        <p class="font-medium">
                            @switch($pendaftaran->status)
                                @case('draft') Draft @break
                                @case('submitted') Terkirim @break
                                @case('verifikasi') Verifikasi @break
                                @case('diterima') Diterima @break
                                @case('ditolak') Ditolak @break
                                @default {{ ucfirst($pendaftaran->status) }}
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500">Tanggal Daftar</span>
                        <p class="font-medium">{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y') : '-' }}</p>
                    </div>
                </div>

                <h4 class="text-sm font-semibold text-gray-700 mb-3">Progress Pendaftaran</h4>
                <div class="space-y-2">
                    @foreach($steps as $i => $step)
                        @php
                            $stepNum = $i + 1;
                            if ($stepNum < $currentStep) $status = 'completed';
                            elseif ($stepNum === $currentStep) $status = 'current';
                            else $status = 'pending';
                        @endphp
                        <div class="flex items-center gap-3 p-2 rounded-lg {{ $status === 'current' ? 'bg-indigo-50 ring-1 ring-indigo-200' : '' }}">
                            <div class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold
                                {{ $status === 'completed' ? 'bg-green-500 text-white' : ($status === 'current' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500') }}">
                                @if($status === 'completed')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @else
                                    {{ $stepNum }}
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium {{ $status === 'completed' ? 'text-green-700' : ($status === 'current' ? 'text-indigo-700' : 'text-gray-500') }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                            @if($status === 'current' && $step['route'])
                                <a href="{{ route($step['route']) }}" class="shrink-0 text-xs text-indigo-600 font-medium hover:underline">Lanjutkan</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </x-card>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-card title="Dokumen Checklist">
                    @php
                        $requiredCount = $pendaftaran->jalur?->persyaratan?->count() ?? 0;
                        $uploadedCount = $dokumen ? $dokumen->count() : 0;
                    @endphp
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">{{ $uploadedCount }} dari {{ $requiredCount }} dokumen terunggah</span>
                        <span class="text-sm font-medium {{ $uploadedCount >= $requiredCount ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ $uploadedCount >= $requiredCount ? 'Lengkap' : 'Belum Lengkap' }}
                        </span>
                    </div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-600 h-2 rounded-full transition-all" style="width: {{ $requiredCount > 0 ? min(100, ($uploadedCount / $requiredCount) * 100) : 0 }}%"></div>
                    </div>
                    <a href="{{ route('siswa.dokumen.index') }}" class="mt-3 inline-block text-sm text-blue-600 hover:underline">Kelola Dokumen &rarr;</a>
                </x-card>

                <x-card title="Biodata">
                    <div class="flex items-center justify-between">
                        @if($siswa && $siswa->nama_lengkap)
                            <span class="text-sm text-green-600 font-medium">Lengkap</span>
                            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @else
                            <span class="text-sm text-yellow-600 font-medium">Belum Lengkap</span>
                            <svg class="h-6 w-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        @endif
                    </div>
                    <a href="{{ route('siswa.biodata.edit') }}" class="mt-3 inline-block text-sm text-blue-600 hover:underline">Lengkapi Biodata &rarr;</a>
                </x-card>
            </div>
        @endif

        <x-card title="Aksi Cepat">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <a href="{{ route('siswa.biodata.edit') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="mt-2 text-xs font-medium text-blue-700">Biodata</span>
                </a>
                <a href="{{ route('siswa.orang-tua.edit') }}" class="flex flex-col items-center p-4 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>
                    </svg>
                    <span class="mt-2 text-xs font-medium text-indigo-700">Orang Tua</span>
                </a>
                <a href="{{ route('siswa.sekolah-asal.edit') }}" class="flex flex-col items-center p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="mt-2 text-xs font-medium text-purple-700">Sekolah Asal</span>
                </a>
                <a href="{{ route('siswa.jalur.index') }}" class="flex flex-col items-center p-4 bg-teal-50 rounded-xl hover:bg-teal-100 transition">
                    <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="mt-2 text-xs font-medium text-teal-700">Pilih Jalur</span>
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
