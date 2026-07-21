<div x-data="chatWidget()" x-init="init()" class="fixed bottom-20 right-4 sm:bottom-6 sm:right-6 z-50">
    {{-- Toggle Button --}}
    <button @click="toggle()"
            class="w-14 h-14 rounded-full shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 flex items-center justify-center relative"
            :class="open ? 'bg-gray-600 dark:bg-slate-600' : 'bg-blue-600 hover:bg-blue-700'"
            :style="open ? '' : 'background-color: var(--warna-primary)'">
        <svg x-show="!open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <svg x-show="open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span x-show="unreadCount > 0 && !open"
              x-text="unreadCount > 9 ? '9+' : unreadCount"
              class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center animate-pulse"></span>
    </button>

    {{-- Chat Window --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         @click.away="open = false"
         class="absolute bottom-16 right-0 w-[340px] sm:w-[380px] bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-slate-700 overflow-hidden flex flex-col"
         style="max-height: 500px;">

        {{-- Header --}}
        <div class="shrink-0 px-4 py-3 border-b border-gray-100 dark:border-slate-700" :style="'background-color: var(--warna-primary)'">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Asisten PPDB</h3>
                    <p class="text-xs text-white/70" x-text="isOperational ? 'Online — siap membantu Anda' : 'Bot aktif 24 jam · Admin jam ' + jamMulai + '-' + jamSelesai + ' WITA'"></p>
                </div>
                <button @click="escalate()" x-show="conversation?.bot_active !== false"
                        class="ml-auto text-[10px] font-bold px-2 py-1 rounded-full bg-white/20 text-white hover:bg-white/30 transition-colors" title="Bicara dengan Admin">
                    🧑‍💻 Admin
                </button>
            </div>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto px-4 py-3 space-y-3 bg-gray-50 dark:bg-slate-900/50" x-ref="chatMessages" x-init="$nextTick(() => scrollToBottom())">
            {{-- Operational hours notice --}}
            <div x-show="!isOperational" class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700/50 rounded-xl px-3 py-2 text-center">
                <p class="text-[11px] font-semibold text-amber-700 dark:text-amber-400">🕐 Jam operasional admin: {{ config('services.chat.jam_mulai', 8) }}.00 – {{ config('services.chat.jam_selesai', 17) }}.00 WITA</p>
                <p class="text-[10px] text-amber-600/70 dark:text-amber-500/70 mt-0.5">Pesan akan dibalas pada jam kerja. Bot tetap aktif 24 jam.</p>
            </div>
            {{-- Welcome message --}}
            <div x-show="messages.length === 0" class="text-center py-6">
                <div class="w-12 h-12 mx-auto rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <p class="text-sm font-semibold text-gray-800 dark:text-white">Halo! 👋</p>
                <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">Saya asisten PPDB AI. Ada yang bisa saya bantu?</p>
                <div class="flex flex-wrap justify-center gap-1.5 mt-3">
                    <button @click="sendQuick('Cara daftar PPDB?')" class="text-[11px] px-3 py-1.5 rounded-full bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:border-blue-400 hover:text-blue-600 transition-colors">Cara daftar</button>
                    <button @click="sendQuick('Apa saja persyaratan dokumen?')" class="text-[11px] px-3 py-1.5 rounded-full bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:border-blue-400 hover:text-blue-600 transition-colors">Persyaratan</button>
                    <button @click="sendQuick('Jadwal PPDB kapan?')" class="text-[11px] px-3 py-1.5 rounded-full bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:border-blue-400 hover:text-blue-600 transition-colors">Jadwal</button>
                    <button @click="sendQuick('Jalur apa saja yang ada?')" class="text-[11px] px-3 py-1.5 rounded-full bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:border-blue-400 hover:text-blue-600 transition-colors">Jalur</button>
                </div>
            </div>

            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.sender_type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.sender_type === 'user'
                        ? 'bg-blue-600 text-white rounded-2xl rounded-br-md max-w-[85%]'
                        : 'bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 text-gray-800 dark:text-slate-200 rounded-2xl rounded-bl-md max-w-[85%]'"
                         class="px-3.5 py-2 shadow-sm">
                        <div x-show="msg.sender_type === 'bot'" class="text-[10px] font-bold text-blue-500 dark:text-blue-400 mb-0.5">🤖 AI Bot</div>
                        <div x-show="msg.sender_type === 'admin'" class="text-[10px] font-bold text-orange-500 dark:text-orange-400 mb-0.5">🧑‍💻 Admin</div>
                        <div class="text-sm whitespace-pre-wrap leading-relaxed" x-text="msg.body"></div>
                    </div>
                </div>
            </template>

            {{-- Typing indicator --}}
            <div x-show="sending" class="flex justify-start">
                <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-600 rounded-2xl rounded-bl-md px-4 py-2.5 shadow-sm">
                    <div class="flex gap-1">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.15s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay:0.3s"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="shrink-0 border-t border-gray-100 dark:border-slate-700 bg-white dark:bg-slate-800 px-3 py-2.5">
            <form @submit.prevent="send()" class="flex items-end gap-2">
                <input x-model="input"
                       @keydown.enter.prevent="send()"
                       type="text"
                       class="flex-1 rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 px-3 py-2 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                       placeholder="Ketik pesan...">
                <button type="submit"
                        :disabled="!input.trim()"
                        class="shrink-0 p-2 rounded-xl text-white hover:opacity-90 disabled:opacity-40 disabled:cursor-not-allowed transition-opacity"
                        :style="'background-color: var(--warna-primary)'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function chatWidget() {
    return {
        open: false,
        input: '',
        messages: [],
        conversation: null,
        sending: false,
        unreadCount: 0,
        pollInterval: null,
        isOperational: true,
        jamMulai: 8,
        jamSelesai: 17,

        async init() {
            await this.fetchMessages();
            this.pollInterval = setInterval(() => {
                this.fetchMessages();
                this.fetchUnread();
            }, 8000);
            this.fetchUnread();
        },

        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.unreadCount = 0;
                this.markRead();
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async fetchMessages() {
            try {
                const res = await fetch('{{ route("peserta.chat.index") }}', {
                    headers: { 'Accept': 'application/json' },
                });
                const data = await res.json();
                this.conversation = data.conversation;
                this.messages = data.messages;
                this.isOperational = data.is_operational;
                this.jamMulai = data.jam_mulai;
                this.jamSelesai = data.jam_selesai;
                if (this.open) this.$nextTick(() => this.scrollToBottom());
            } catch (e) { /* silent */ }
        },

        async fetchUnread() {
            try {
                const res = await fetch('{{ route("peserta.chat.unread-count") }}', {
                    headers: { 'Accept': 'application/json' },
                });
                const data = await res.json();
                this.unreadCount = data.count;
            } catch (e) { /* silent */ }
        },

        async markRead() {
            try {
                await fetch('{{ route("peserta.chat.mark-read") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });
                this.unreadCount = 0;
            } catch (e) { /* silent */ }
        },

        async send() {
            if (!this.input.trim()) return;
            await this.sendMessage(this.input);
            this.input = '';
        },

        async sendQuick(text) {
            await this.sendMessage(text);
        },

        async sendMessage(text) {
            this.sending = true;
            try {
                const res = await fetch('{{ route("peserta.chat.send") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ message: text }),
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);
                const data = await res.json();
                this.messages.push(data.user_message);
                if (data.bot_message) this.messages.push(data.bot_message);
                this.$nextTick(() => this.scrollToBottom());
            } catch (e) {
                this.messages.push({
                    id: 'err-' + Date.now(),
                    sender_type: 'bot',
                    body: 'Maaf, terjadi gangguan koneksi. Silakan coba lagi.',
                });
                this.$nextTick(() => this.scrollToBottom());
            }
            this.sending = false;
        },

        async escalate() {
            if (!this.conversation) return;
            try {
                await fetch('{{ route("peserta.chat.escalate") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });
                await this.fetchMessages();
            } catch (e) { /* silent */ }
        },

        scrollToBottom() {
            const el = this.$refs.chatMessages;
            if (el) el.scrollTop = el.scrollHeight;
        },
    }
}
</script>
