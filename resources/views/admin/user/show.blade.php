<x-app-layout>
    <x-slot name="header">Detail User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('admin.user.index')],
            ['label' => 'Detail'],
        ]" />

        <div class="flex items-center justify-between">
            <x-icon-button :href="route('admin.user.index')" variant="default" title="Kembali">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </x-icon-button>
            <x-icon-button :href="route('admin.user.edit', $user)" variant="warning" title="Ubah">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </x-icon-button>
        </div>

        <x-card>
            <div class="p-5">
                <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100 dark:border-slate-700">
                    <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center shrink-0">
                        <span class="text-white font-bold text-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-slate-400">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label value="Nama" />
                        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600">{{ $user->name }}</p>
                    </div>
                    <div>
                        <x-input-label value="Email" />
                        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600">{{ $user->email }}</p>
                    </div>
                    <div>
                        <x-input-label value="Role" />
                        <div class="mt-1 flex flex-wrap gap-1.5 bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600 min-h-[40px] items-center">
                            @forelse($user->roles as $role)
                                <x-badge color="blue">{{ $role->name }}</x-badge>
                            @empty
                                <span class="text-sm text-gray-400">-</span>
                            @endforelse
                        </div>
                    </div>
                    <div>
                        <x-input-label value="Status" />
                        <div class="mt-1 flex items-center gap-2">
                            @if($user->is_active ?? true)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                            @if(auth()->user()->can('user.edit') && $user->id !== auth()->id())
                                <form action="{{ route('admin.user.toggle-status', $user) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline">
                                        {{ ($user->is_active ?? true) ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div>
                        <x-input-label value="Email Terverifikasi" />
                        <div class="mt-1 flex items-center gap-2">
                            @if($user->hasVerifiedEmail())
                                <x-badge color="green">Terverifikasi</x-badge>
                            @else
                                <x-badge color="yellow">Belum Terverifikasi</x-badge>
                            @endif
                            @if(auth()->user()->can('user.edit'))
                                @if(!$user->hasVerifiedEmail())
                                    <form action="{{ route('admin.user.verify-email', $user) }}" method="POST" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline">
                                            Verifikasi sekarang
                                        </button>
                                    </form>
                                    <span class="text-xs text-gray-400">|</span>
                                    <form action="{{ route('admin.user.send-verification', $user) }}" method="POST" class="inline">
                                        @csrf @method('POST')
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 underline">
                                            Kirim ulang email verifikasi
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div>
                        <x-input-label value="Terdaftar Sejak" />
                        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600">{{ $user->created_at->translatedFormat('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
