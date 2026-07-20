<x-app-layout>
    <x-slot name="header">Notifikasi</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Notifikasi'],
        ]" />

        <x-admin.module-header title="Notifikasi" description="Lihat semua notifikasi sistem. Tandai sudah dibaca atau hapus yang tidak perlu.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button onclick="markAllRead()" id="markAllBtn">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Tandai Semua Dibaca
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50 overflow-hidden" x-data="notifPage()">
            <div class="p-6">
                <template x-if="loading">
                    <div class="flex items-center justify-center py-12">
                        <svg class="w-6 h-6 animate-spin theme-text" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                        <span class="ml-3 text-sm text-gray-500 dark:text-slate-400">Memuat notifikasi...</span>
                    </div>
                </template>
                <template x-if="!loading && notifications.length === 0">
                    <div class="flex flex-col items-center justify-center py-12">
                        <div class="w-16 h-16 rounded-2xl theme-bg-light flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 theme-text opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Tidak ada notifikasi</p>
                    </div>
                </template>
                <template x-if="!loading && notifications.length > 0">
                    <div class="space-y-2">
                        <template x-for="notif in notifications" :key="notif.id">
                            <div class="flex items-start gap-3 p-4 rounded-xl transition-all duration-200" :class="!notif.read_at ? 'bg-gray-50 dark:bg-slate-700/30 border border-gray-100 dark:border-slate-600/50' : 'hover:bg-gray-50 dark:hover:bg-slate-700/30'">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" :class="!notif.read_at ? 'theme-bg-light' : 'bg-gray-100 dark:bg-slate-700'">
                                    <svg class="w-5 h-5 theme-text" :class="notif.read_at ? 'opacity-50' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium" :class="!notif.read_at ? 'text-gray-900 dark:text-white' : 'text-gray-600 dark:text-slate-400'" x-text="notif.data?.title || 'Notifikasi'"></p>
                                    <p class="text-xs text-gray-500 dark:text-slate-400 mt-1" x-text="notif.created_at ? new Date(notif.created_at).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric',hour:'2-digit',minute:'2-digit'}) : ''"></p>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <template x-if="!notif.read_at">
                                        <button @click="markAsRead(notif.id)" class="text-xs theme-text hover:underline font-medium">Tandai dibaca</button>
                                    </template>
                                    <template x-if="notif.read_at">
                                        <span class="text-xs text-gray-400 dark:text-slate-500">Dibaca</span>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <template x-if="lastPage > 1">
                <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 dark:border-slate-700">
                    <p class="text-xs text-gray-500 dark:text-slate-400">
                        Halaman <span x-text="currentPage"></span> dari <span x-text="lastPage"></span>
                    </p>
                    <div class="flex gap-1">
                        <button @click="fetchNotifs(currentPage - 1)" :disabled="currentPage <= 1" class="px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                            Sebelumnya
                        </button>
                        <button @click="fetchNotifs(currentPage + 1)" :disabled="currentPage >= lastPage" class="px-3 py-1.5 text-xs font-medium rounded-lg border border-gray-200 dark:border-slate-600 text-gray-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 disabled:opacity-40 disabled:cursor-not-allowed transition-colors">
                            Berikutnya
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    @push('scripts')
    <script>
        function notifPage() {
            return {
                notifications: [],
                loading: true,
                currentPage: 1,
                lastPage: 1,

                async init() {
                    await this.fetchNotifs(1);
                },

                async fetchNotifs(page = 1) {
                    this.loading = true;
                    try {
                        const res = await fetch(`{{ route('admin.notifikasi.api') }}?page=${page}`, {
                            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        const data = await res.json();
                        this.notifications = data.data || [];
                        this.currentPage = data.current_page;
                        this.lastPage = data.last_page;
                    } catch (e) {
                        console.error('Gagal memuat notifikasi:', e);
                    } finally {
                        this.loading = false;
                    }
                },

                async markAsRead(id) {
                    try {
                        await fetch(`{{ url('admin/notifikasi') }}/${id}/read`, {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        const notif = this.notifications.find(n => n.id === id);
                        if (notif) notif.read_at = new Date().toISOString();
                        window.dispatchEvent(new Event('notif-updated'));
                    } catch (e) {
                        console.error(e);
                    }
                }
            };
        }

        async function markAllRead() {
            try {
                await fetch(`{{ route('admin.notifikasi.read-all') }}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' }
                });
                window.dispatchEvent(new Event('notif-updated'));
                location.reload();
            } catch (e) {
                console.error(e);
            }
        }
    </script>
    @endpush
</x-app-layout>
