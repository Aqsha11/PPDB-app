@props(['color' => 'gray'])

@php
    $colors = [
        'gray' => 'bg-gray-100 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
        'red' => 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-400',
        'yellow' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400',
        'green' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400',
        'blue' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-400',
        'indigo' => 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-400',
        'purple' => 'bg-purple-50 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400',
        'pink' => 'bg-pink-50 text-pink-700 dark:bg-pink-500/15 dark:text-pink-400',
    ];
    $class = $colors[$color] ?? $colors['gray'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold ' . $class]) }}>
    {{ $slot }}
</span>
