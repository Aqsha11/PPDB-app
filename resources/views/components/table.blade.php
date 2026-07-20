@props(['headers' => []])

<div {{ $attributes->merge(['class' => 'overflow-x-auto']) }}>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
        @if(count($headers) > 0)
            <thead>
                <tr class="bg-gray-50 dark:bg-slate-700/50">
                    @foreach($headers as $header)
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider first:pl-5 last:pr-5">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody class="divide-y divide-gray-100 dark:divide-slate-700/50 bg-white dark:bg-slate-800">
            {{ $slot }}
        </tbody>
    </table>
</div>
