@props(['label' => '', 'value' => '', 'icon' => null, 'color' => 'blue'])

@php
    $colorMap = [
        'blue' => ['bg' => 'bg-blue-50 dark:bg-blue-500/10', 'text' => 'text-blue-600 dark:text-blue-400', 'gradient' => 'stat-gradient-blue'],
        'green' => ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'text' => 'text-emerald-600 dark:text-emerald-400', 'gradient' => 'stat-gradient-green'],
        'yellow' => ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'text' => 'text-amber-600 dark:text-amber-400', 'gradient' => 'stat-gradient-amber'],
        'red' => ['bg' => 'bg-red-50 dark:bg-red-500/10', 'text' => 'text-red-600 dark:text-red-400', 'gradient' => 'stat-gradient-red'],
        'purple' => ['bg' => 'bg-purple-50 dark:bg-purple-500/10', 'text' => 'text-purple-600 dark:text-purple-400', 'gradient' => 'stat-gradient-purple'],
        'indigo' => ['bg' => 'bg-indigo-50 dark:bg-indigo-500/10', 'text' => 'text-indigo-600 dark:text-indigo-400', 'gradient' => 'stat-gradient-blue'],
    ];
    $c = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 p-5 shadow-sm hover:shadow-md transition-all duration-300']) }}>
    <div class="flex items-center gap-4">
        @if($icon)
            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 {{ $c['bg'] }}">
                <svg class="w-5 h-5 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            </div>
        @endif
        <div class="min-w-0">
            <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">{{ $label }}</p>
            @if($slot->isNotEmpty())
                <div class="mt-1">{{ $slot }}</div>
            @else
                <p class="mt-1 text-sm font-bold text-gray-900 dark:text-white truncate">{{ $value }}</p>
            @endif
        </div>
    </div>
</div>
