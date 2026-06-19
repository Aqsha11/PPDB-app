<x-app-layout>
    <x-slot name="header">Daftar Ulang</x-slot>

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

        @if(!$pendaftaran)
            <x-card>
                <div class="text-center py-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-4 text-gray-600 font-medium">Belum ada pendaftaran</p>
                    <p class="text-sm text-gray-500 mt-1">Silakan melakukan pendaftaran terlebih dahulu.</p>
                    <a href="{{ route('siswa.jalur.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Mulai Pendaftaran &rarr;</a>
                </div>
            </x-card>
        @elseif($daftarUlang)
            <x-card title="Status Daftar Ulang">
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
                    <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-green-800">Daftar Ulang Berhasil</h3>
                    <p class="mt-2 text-sm text-green-700">
                        Anda telah melakukan daftar ulang pada {{ $daftarUlang->tanggal_daftar_ulang ? \Carbon\Carbon::parse($daftarUlang->tanggal_daftar_ulang)->format('d F Y H:i') : ($daftarUlang->created_at ? $daftarUlang->created_at->format('d F Y H:i') : '-') }}.
                    </p>
                    <div class="mt-4 inline-block bg-green-700 text-white px-6 py-2 rounded-lg font-medium text-sm">
                        Status: {{ ucfirst($daftarUlang->status ?? 'Terkonfirmasi') }}
                    </div>
                </div>
            </x-card>
        @elseif($pendaftaran->status === 'diterima')
            <x-card title="Selamat!">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-8 text-center text-white">
                    <svg class="mx-auto h-16 w-16 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-2xl font-bold">Selamat Anda Diterima!</h3>
                    <p class="mt-2 text-white/80">Anda telah diterima sebagai calon siswa baru. Silakan melakukan daftar ulang untuk mengkonfirmasi tempat Anda.</p>
                    <form method="POST" action="{{ route('siswa.daftar-ulang.store') }}" class="mt-6" onsubmit="return confirm('Yakin akan melakukan daftar ulang?')">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-white text-green-700 font-semibold rounded-lg hover:bg-green-50 transition">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            Daftar Ulang Sekarang
                        </button>
                    </form>
                </div>
            </x-card>

            <x-card title="Informasi Daftar Ulang">
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Daftar ulang dapat dilakukan hingga batas waktu yang ditentukan oleh panitia PPDB.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-green-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Setelah daftar ulang, status Anda akan dikonfirmasi oleh pihak sekolah.</span>
                    </li>
                </ul>
            </x-card>
        @elseif($pendaftaran->status === 'ditolak')
            <x-card title="Mohon Maaf">
                <div class="bg-red-50 border border-red-200 rounded-xl p-8 text-center">
                    <svg class="mx-auto h-16 w-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-red-800">Mohon Maaf</h3>
                    <p class="mt-2 text-sm text-red-700">Pendaftaran Anda belum dapat diterima. Silakan hubungi panitia PPDB untuk informasi lebih lanjut.</p>
                </div>
            </x-card>
        @else
            <x-card>
                <div class="text-center py-8">
                    <svg class="mx-auto h-16 w-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Menunggu Pengumuman</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Status pendaftaran Anda:
                        <span class="font-medium">
                            @switch($pendaftaran->status)
                                @case('draft') Draft @break
                                @case('submitted') Sedang Diproses @break
                                @case('verifikasi') Dalam Verifikasi @break
                                @default {{ ucfirst($pendaftaran->status) }}
                            @endswitch
                        </span>
                    </p>
                    <p class="text-sm text-gray-400 mt-1">Halaman daftar ulang akan tersedia jika Anda dinyatakan diterima.</p>
                </div>
            </x-card>
        @endif
    </div>
</x-app-layout>
