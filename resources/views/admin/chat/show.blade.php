<x-app-layout>
    <div class="flex flex-col h-[calc(100vh-8rem)]" x-data="adminChat({{ $conversation->id }})">
        {{-- Header --}}
        <div class="shrink-0 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-t-xl px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.chat.index') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div class="w-9 h-9 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-sm">
                    {{ strtoupper(substr($conversation->user->name ?? '?', 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white">{{ $conversation->user->name ?? '-' }}</h2>
                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ $conversation->user->email ?? '' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span x-show="botActive" class="text-[10px] font-bold px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400">BOT AKTIF</span>
                <span x-show="!botActive" class="text-[10px] font-bold px-2 py-1 rounded-full bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400">MANUAL</span>
                <button @click="toggleBot()" class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors" title="Toggle Bot">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </button>
                @if($conversation->status === 'open')
                    <button @click="closeChat()" class="p-1.5 rounded-lg text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-500 transition-colors" title="Tutup Percakapan">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                @endif
            </div>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto border-x border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/50 px-4 py-4 space-y-3" x-ref="messagesContainer" x-init="scrollToBottom()">
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.sender_type === 'admin' ? 'flex justify-end' : (msg.sender_type === 'bot' ? 'flex justify-start' : 'flex justify-start')">
                    <div :class="msg.sender_type === 'admin'
                        ? 'bg-blue-600 text-white rounded-2xl rounded-br-md max-w-[75%]'
                        : (msg.sender_type === 'bot'
                            ? 'bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 text-gray-800 dark:text-slate-200 rounded-2xl rounded-bl-md max-w-[75%]'
                            : 'bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 text-gray-800 dark:text-slate-200 rounded-2xl rounded-bl-md max-w-[75%]')"
                         class="px-4 py-2.5 shadow-sm">
                        <div x-show="msg.sender_type === 'bot'" class="text-[10px] font-bold text-blue-500 dark:text-blue-400 mb-1">🤖 Bot AI</div>
                        <div class="text-sm whitespace-pre-wrap" x-text="msg.body"></div>
                        <div class="text-[10px] mt-1 text-right" :class="msg.sender_type === 'admin' ? 'text-blue-200' : 'text-gray-400 dark:text-slate-500'" x-text="msg.time"></div>
                    </div>
                </div>
            </template>
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 rounded-2xl rounded-bl-md px-4 py-3 shadow-sm">
                    <div class="flex gap-1">
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0s"></span>
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.15s"></span>
                        <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.3s"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="shrink-0 border border-t-0 border-gray-200 dark:border-slate-700 rounded-b-xl bg-white dark:bg-slate-800 px-4 py-3" x-show="conversation.status === 'open'">
            <form @submit.prevent="sendMessage()" class="flex items-end gap-2">
                <div class="flex-1">
                    <textarea x-model="newMessage"
                              @keydown.enter.prevent="if(!$event.shiftKey) sendMessage()"
                              rows="1"
                              class="w-full resize-none rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 px-4 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Ketik pesan..."></textarea>
                </div>
                <button type="submit"
                        :disabled="!newMessage.trim()"
                        class="shrink-0 p-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>
        </div>
        <div x-show="conversation.status === 'closed'" class="shrink-0 border border-t-0 border-gray-200 dark:border-slate-700 rounded-b-xl bg-gray-50 dark:bg-slate-800 px-4 py-3 text-center">
            <p class="text-sm text-gray-500 dark:text-slate-400">Percakapan telah ditutup.</p>
            <button @click="reopenChat()" class="mt-2 text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">Buka Kembali</button>
        </div>
    </div>

    @push('scripts')
    <script>
        function adminChat(conversationId) {
            return {
                conversationId,
                conversation: { status: 'open' },
                messages: [],
                newMessage: '',
                loading: false,
                botActive: true,
                pollInterval: null,

                init() {
                    this.fetchMessages();
                    this.pollInterval = setInterval(() => this.fetchMessages(), 5000);
                },

                destroy() {
                    if (this.pollInterval) clearInterval(this.pollInterval);
                },

                async fetchMessages() {
                    try {
                        const res = await fetch(`/admin/chat/${this.conversationId}`, {
                            headers: { 'Accept': 'application/json' },
                        });
                        const data = await res.json();
                        this.messages = data.messages;
                        this.conversation = data.conversation;
                        this.botActive = data.conversation.bot_active;
                        this.$nextTick(() => this.scrollToBottom());
                    } catch (e) { /* silent */ }
                },

                async sendMessage() {
                    if (!this.newMessage.trim()) return;
                    const body = this.newMessage;
                    this.newMessage = '';
                    this.loading = true;

                    try {
                        const res = await fetch(`/admin/chat/${this.conversationId}/reply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ message: body }),
                        });
                        const data = await res.json();
                        this.messages.push(data.message);
                        this.$nextTick(() => this.scrollToBottom());
                    } catch (e) { this.newMessage = body; }
                    this.loading = false;
                },

                async closeChat() {
                    if (!confirm('Tutup percakapan ini?')) return;
                    await fetch(`/admin/chat/${this.conversationId}/close`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    });
                    await this.fetchMessages();
                },

                async reopenChat() {
                    await fetch(`/admin/chat/${this.conversationId}/reopen`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    });
                    await this.fetchMessages();
                },

                async toggleBot() {
                    const res = await fetch(`/admin/chat/${this.conversationId}/toggle-bot`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        Accept: 'application/json',
                    });
                    const data = await res.json();
                    this.botActive = data.bot_active;
                    await this.fetchMessages();
                },

                scrollToBottom() {
                    const el = this.$refs.messagesContainer;
                    if (el) el.scrollTop = el.scrollHeight;
                },
            }
        }
    </script>
    @endpush
</x-app-layout>
