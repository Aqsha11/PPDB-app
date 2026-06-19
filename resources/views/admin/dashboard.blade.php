<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <x-stat-card title="Total Siswa" :value="$totalSiswa" color="blue" trend="up" trend-value="12.5%">
                <x-slot name="icon">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                </x-slot>
            </x-stat-card>
            <x-stat-card title="Total Pendaftar" :value="$totalPendaftar" color="indigo" trend="up" trend-value="8.2%">
                <x-slot name="icon">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </x-slot>
            </x-stat-card>
            <x-stat-card title="Pending Verifikasi" :value="$pending" color="yellow" trend="down" trend-value="3.1%">
                <x-slot name="icon">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
            </x-stat-card>
            <x-stat-card title="Diterima" :value="$diterima" color="green" trend="up" trend-value="15.3%">
                <x-slot name="icon">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
            </x-stat-card>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Grafik Pendaftaran</h3>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <p class="text-sm text-gray-400">Grafik akan tersedia setelah integrasi data</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    @forelse(App\Models\LogAktivitas::latest()->take(5)->get() as $log)
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 mt-2 rounded-full bg-blue-500 shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">{{ $log->deskripsi ?? $log->aktivitas }}</p>
                                <p class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-10 h-10 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-400">Belum ada aktivitas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Status Pendaftaran</h3>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        </svg>
                        <p class="text-sm text-gray-400">Chart distribusi akan tersedia setelah integrasi data</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan PPDB</h3>
                <div class="space-y-3">
                    @php
                        $diverifikasi = App\Models\Pendaftaran::where('status_pendaftaran', 'diverifikasi')->count();
                        $ditolak = App\Models\Pendaftaran::where('status_pendaftaran', 'ditolak')->count();
                        $belumVerifikasi = App\Models\Pendaftaran::where('status_pendaftaran', 'submitted')->count();
                        $daftarUlang = App\Models\HasilSeleksi::where('status', 'daftar_ulang')->count();
                    @endphp
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <span class="text-sm text-gray-600">Total Pendaftar</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $totalPendaftar }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <span class="text-sm text-gray-600">Sudah Diverifikasi</span>
                        <span class="text-sm font-semibold text-emerald-600">{{ $diverifikasi }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <span class="text-sm text-gray-600">Belum Verifikasi</span>
                        <span class="text-sm font-semibold text-yellow-600">{{ $belumVerifikasi }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <span class="text-sm text-gray-600">Diterima</span>
                        <span class="text-sm font-semibold text-blue-600">{{ $diterima }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <span class="text-sm text-gray-600">Ditolak</span>
                        <span class="text-sm font-semibold text-red-600">{{ $ditolak }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-sm text-gray-600">Daftar Ulang</span>
                        <span class="text-sm font-semibold text-purple-600">{{ $daftarUlang }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
