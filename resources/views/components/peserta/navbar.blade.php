<div class="flex items-center justify-between h-16 px-4 sm:px-6 border-b border-white/10 dark:border-white/5 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl">
    <div class="flex items-center gap-3">
        <a href="{{ route('peserta.dashboard') }}" class="flex items-center space-x-2 group">
            @if(isset($profil) && $profil?->logo)
                <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-8 w-auto transition-transform group-hover:scale-105">
            @else
                <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-transform group-hover:scale-105 theme-bg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            @endif
            <span class="text-lg font-bold text-gray-900 dark:text-white hidden sm:block">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
        </a>
    </div>

    <div class="flex items-center gap-2">
        <x-theme-toggle />
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" class="flex items-center space-x-2 p-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-all duration-200">
                @if(auth()->user()->peserta?->pas_foto)
                    <img src="{{ Storage::url(auth()->user()->peserta->pas_foto) }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-xl object-cover shadow-sm">
                @else
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center theme-bg">
                        <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                @endif
                <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-slate-700 py-1 z-50">
                <div class="px-4 py-3 border-b border-gray-100 dark:border-slate-700">
                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider mt-0.5">Peserta</p>
                </div>
                <a href="{{ route('peserta.profil.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                    <svg class="w-4 h-4 mr-3 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil Saya
                </a>
                <hr class="my-1 border-gray-100 dark:border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                        <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
