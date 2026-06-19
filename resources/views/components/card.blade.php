@props(['title' => null, 'subtitle' => null, 'footer' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden']) }}>
    @if($title)
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            @if($subtitle)
                <p class="mt-0.5 text-sm text-gray-500">{{ $subtitle }}</p>
            @endif
        </div>
    @endif
    <div @if($padding) class="p-6" @endif>
        {{ $slot }}
    </div>
    @if($footer)
        <div class="px-6 py-3 border-t border-gray-100 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>