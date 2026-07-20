@props(['title', 'value', 'icon' => null, 'color' => 'blue'])

@php
    $colors = [
        'blue' => ['bg' => 'theme-bg-light', 'icon' => 'theme-text', 'border' => 'border-[var(--color-primary)]/20'],
        'green' => ['bg' => 'bg-emerald-50', 'icon' => 'text-emerald-600', 'border' => 'border-emerald-200'],
        'yellow' => ['bg' => 'bg-amber-50', 'icon' => 'text-amber-600', 'border' => 'border-amber-200'],
        'red' => ['bg' => 'bg-red-50', 'icon' => 'text-red-600', 'border' => 'border-red-200'],
        'indigo' => ['bg' => 'bg-indigo-50', 'icon' => 'text-indigo-600', 'border' => 'border-indigo-200'],
        'purple' => ['bg' => 'bg-purple-50', 'icon' => 'text-purple-600', 'border' => 'border-purple-200'],
        'pink' => ['bg' => 'bg-pink-50', 'icon' => 'text-pink-600', 'border' => 'border-pink-200'],
        'teal' => ['bg' => 'bg-teal-50', 'icon' => 'text-teal-600', 'border' => 'border-teal-200'],
    ];
    $c = $colors[$color] ?? $colors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50 p-5 hover:shadow-lg hover:shadow-gray-200/50 dark:hover:shadow-slate-900/20 transition-all duration-300 group-hover:-translate-y-0.5']) }}>
    <div class="flex items-start justify-between">
        <div class="flex-1 min-w-0">
            <p class="text-[11px] font-bold text-gray-500 dark:text-slate-400 uppercase tracking-wider">{{ $title }}</p>
            <p class="mt-2 text-2xl font-extrabold text-gray-900 dark:text-white">{{ $value }}</p>
        </div>
        @if($icon)
            <div class="w-11 h-11 {{ $c['bg'] }} rounded-xl flex items-center justify-center shrink-0 ml-3 transition-transform group-hover:scale-110">
                {!! $icon !!}
            </div>
        @endif
    </div>
</div>
