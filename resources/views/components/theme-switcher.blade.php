@props(['variant' => 'navbar'])

@php
    $themeColors = [
        'sekolah' => ['hex' => '', 'label' => 'Sekolah', 'gradient' => true],
        'blue'    => ['hex' => '#2563EB', 'label' => 'Biru'],
        'indigo'  => ['hex' => '#4F46E5', 'label' => 'Indigo'],
        'purple'  => ['hex' => '#7C3AED', 'label' => 'Ungu'],
        'pink'    => ['hex' => '#EC4899', 'label' => 'Pink'],
        'red'     => ['hex' => '#DC2626', 'label' => 'Merah'],
        'orange'  => ['hex' => '#F97316', 'label' => 'Oranye'],
        'green'   => ['hex' => '#059669', 'label' => 'Hijau'],
        'teal'    => ['hex' => '#0D9488', 'label' => 'Tosca'],
    ];
@endphp

<div class="relative hidden sm:block" @click.outside="open = false">
    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-500 hover:text-gray-700 dark:text-slate-400 dark:hover:text-white transition-colors rounded-xl hover:bg-gray-100 dark:hover:bg-slate-700" aria-label="Theme">
        <span class="w-4 h-4 rounded-full border-2 border-current shrink-0" :style="'background-color: ' + (colors[color]?.hex || 'var(--warna-primary)')"></span>
        <svg x-show="mode === 'light'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <svg x-show="mode === 'dark'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
        <svg x-show="mode === 'system'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <svg class="w-3 h-3 text-gray-400 dark:text-slate-500 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-gray-100 dark:border-slate-700 py-3 z-50">

        <div class="px-4 pb-2">
            <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider mb-2.5">Warna Tema</p>
            <div class="grid grid-cols-5 gap-2">
                @foreach($themeColors as $key => $tc)
                    <button @click="setColor('{{ $key }}')" class="group relative flex items-center justify-center" title="{{ $tc['label'] }}">
                        <span class="w-7 h-7 rounded-full border-2 transition-all duration-200 flex items-center justify-center
                            {{ $key === 'sekolah' ? 'border-gray-300 dark:border-slate-600 bg-gradient-to-br from-blue-500 to-purple-500' : '' }}
                            " @if(!empty($tc['hex'])) style="background-color: {{ $tc['hex'] }}" @endif
                            :class="color === '{{ $key }}' ? 'border-gray-900 dark:border-white scale-110 ring-2 ring-offset-1 ring-gray-900/20 dark:ring-white/20 dark:ring-offset-slate-800' : 'border-transparent hover:border-gray-300 dark:hover:border-slate-500'"
                        >
                            <svg x-show="color === '{{ $key }}'" class="w-3 h-3 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                    </button>
                @endforeach
            </div>
        </div>

        <hr class="my-2 border-gray-100 dark:border-slate-700">

        <div class="px-4 pt-1">
            <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider mb-2">Mode Tampilan</p>
            <div class="grid grid-cols-3 gap-1.5">
                <button @click="setMode('system')" class="flex flex-col items-center gap-1.5 py-2 rounded-lg text-xs transition-all duration-200" :class="mode === 'system' ? 'theme-bg-light theme-text font-semibold' : 'text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700/50'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Sistem
                </button>
                <button @click="setMode('light')" class="flex flex-col items-center gap-1.5 py-2 rounded-lg text-xs transition-all duration-200" :class="mode === 'light' ? 'theme-bg-light theme-text font-semibold' : 'text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700/50'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Terang
                </button>
                <button @click="setMode('dark')" class="flex flex-col items-center gap-1.5 py-2 rounded-lg text-xs transition-all duration-200" :class="mode === 'dark' ? 'theme-bg-light theme-text font-semibold' : 'text-gray-500 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700/50'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    Gelap
                </button>
            </div>
        </div>
    </div>
</div>
