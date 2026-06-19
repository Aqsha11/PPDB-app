@props(['title', 'value', 'icon' => null, 'color' => 'blue', 'trend' => null, 'trendValue' => null])

@php
    $colors = [
        'blue' => 'bg-blue-500',
        'green' => 'bg-emerald-500',
        'yellow' => 'bg-yellow-500',
        'red' => 'bg-red-500',
        'indigo' => 'bg-indigo-500',
        'purple' => 'bg-purple-500',
        'pink' => 'bg-pink-500',
        'teal' => 'bg-teal-500',
    ];
    $bgColors = [
        'blue' => 'bg-blue-50',
        'green' => 'bg-emerald-50',
        'yellow' => 'bg-yellow-50',
        'red' => 'bg-red-50',
        'indigo' => 'bg-indigo-50',
        'purple' => 'bg-purple-50',
        'pink' => 'bg-pink-50',
        'teal' => 'bg-teal-50',
    ];
    $iconColors = [
        'blue' => 'text-blue-600',
        'green' => 'text-emerald-600',
        'yellow' => 'text-yellow-600',
        'red' => 'text-red-600',
        'indigo' => 'text-indigo-600',
        'purple' => 'text-purple-600',
        'pink' => 'text-pink-600',
        'teal' => 'text-teal-600',
    ];
    $dot = $colors[$color] ?? $colors['blue'];
    $bg = $bgColors[$color] ?? $bgColors['blue'];
    $iconColor = $iconColors[$color] ?? $iconColors['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 p-6']) }}>
    <div class="flex items-center justify-between">
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
            <p class="mt-1 text-2xl font-bold text-gray-900">{{ $value }}</p>
            @if($trend)
                <div class="flex items-center mt-1">
                    @if($trend === 'up')
                        <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        <span class="text-xs font-medium text-green-600">{{ $trendValue ?? '' }}</span>
                    @elseif($trend === 'down')
                        <svg class="w-4 h-4 text-red-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        <span class="text-xs font-medium text-red-600">{{ $trendValue ?? '' }}</span>
                    @else
                        <span class="text-xs font-medium text-gray-500">{{ $trendValue ?? '' }}</span>
                    @endif
                </div>
            @endif
        </div>
        @if($icon)
            <div class="w-12 h-12 {{ $bg }} rounded-xl flex items-center justify-center shrink-0 ml-4">
                {!! $icon !!}
            </div>
        @else
            <div class="w-12 h-12 {{ $bg }} rounded-xl flex items-center justify-center shrink-0 ml-4">
                <div class="w-3 h-3 rounded-full {{ $dot }}"></div>
            </div>
        @endif
    </div>
</div>