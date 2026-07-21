<x-app-layout>
    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Chat Peserta']]" />
        <x-admin.module-header title="Chat Peserta" description="Kelola percakapan dengan peserta PPDB. Bot AI akan menjawab pertanyaan umum secara otomatis." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z' />" />

        @if($conversations->isEmpty())
            <x-card>
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <h3 class="mt-3 text-sm font-medium text-gray-900 dark:text-white">Belum ada percakapan</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Percakapan dari peserta akan muncul di sini.</p>
                </div>
            </x-card>
        @else
            {{-- Active Conversations --}}
            <x-card>
                <h3 class="text-sm font-bold text-gray-500 dark:text-slate-400 mb-3">Percakapan Aktif ({{ $conversations->count() }})</h3>
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @foreach($conversations as $conv)
                        <a href="{{ route('admin.chat.show', $conv['id']) }}"
                           class="flex items-center gap-4 p-3 -mx-3 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg transition-colors">
                            <div class="relative shrink-0">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-sm">
                                    {{ strtoupper(substr($conv['user']->name ?? '?', 0, 1)) }}
                                </div>
                                @if($conv['unread_count'] > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                        {{ $conv['unread_count'] > 9 ? '9+' : $conv['unread_count'] }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ $conv['subject'] }}</span>
                                    <span class="text-xs text-gray-400 dark:text-slate-500 shrink-0">{{ $conv['last_message_at'] }}</span>
                                </div>
                                <div class="flex items-center gap-2 mt-0.5">
                                    @if(!$conv['bot_active'])
                                        <span class="shrink-0 text-[10px] font-bold px-1.5 py-0.5 rounded bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400">ADMIN</span>
                                    @endif
                                    <p class="text-xs text-gray-500 dark:text-slate-400 truncate">{{ $conv['last_message'] }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </x-card>
        @endif

        {{-- Closed Conversations --}}
        @if($closedConversations->isNotEmpty())
            <x-card>
                <h3 class="text-sm font-bold text-gray-500 dark:text-slate-400 mb-3">Percakapan Selesai ({{ $closedConversations->count() }})</h3>
                <div class="divide-y divide-gray-100 dark:divide-slate-700">
                    @foreach($closedConversations as $conv)
                        <a href="{{ route('admin.chat.show', $conv['id']) }}"
                           class="flex items-center gap-4 p-3 -mx-3 hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-lg transition-colors opacity-60">
                            <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center text-gray-500 dark:text-slate-400 font-bold text-sm">
                                {{ strtoupper(substr($conv['user']->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-medium text-sm text-gray-700 dark:text-slate-300 truncate">{{ $conv['subject'] }}</span>
                                    <span class="text-xs text-gray-400 dark:text-slate-500 shrink-0">{{ $conv['last_message_at'] }}</span>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-slate-500 truncate mt-0.5">{{ $conv['last_message'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </x-card>
        @endif
    </div>
</x-app-layout>
