<x-app-layout>
    <x-slot name="header">Detail User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('admin.user.index')],
            ['label' => 'Detail']
        ]" />

        <x-card>
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <span class="text-blue-600 font-bold text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama</label>
                    <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Roles</label>
                    <div class="flex flex-wrap gap-1.5 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200 min-h-[40px] items-center">
                        @forelse($user->roles as $role)
                            <x-badge color="blue">{{ $role->name }}</x-badge>
                        @empty
                            <span class="text-sm text-gray-400">-</span>
                        @endforelse
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Terdaftar Sejak</label>
                    <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            @if($user->siswa ?? null)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">Data Siswa Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">NISN</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->siswa->nisn ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->siswa->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tempat Lahir</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->siswa->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Lahir</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ isset($user->siswa->tanggal_lahir) ? \Carbon\Carbon::parse($user->siswa->tanggal_lahir)->format('d M Y') : '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Kelamin</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->siswa->jenis_kelamin ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Asal Sekolah</label>
                            <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $user->siswa->asal_sekolah ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.user.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit User</a>
                <a href="{{ route('admin.user.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Kembali</a>
            </div>
        </x-card>
    </div>
</x-app-layout>
