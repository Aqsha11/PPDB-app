<header class="sticky top-0 z-40 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl border-b border-gray-100 dark:border-slate-700/50">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <button @click="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-slate-400 dark:hover:text-white transition-colors p-2 -ml-2 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-700" aria-label="Toggle sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <x-breadcrumb :items="$breadcrumb ?? []" />
        </div>
        <div class="flex items-center space-x-1 sm:space-x-2">
            <div class="hidden sm:block relative">
                <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Cari..." class="w-52 lg:w-64 pl-9 pr-3 py-2 text-sm border-0 rounded-xl bg-gray-50 dark:bg-slate-700/50 text-gray-700 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none search-focus transition-all">
            </div>

            <x-theme-switcher />

            <div class="relative" x-data="notificationDropdown()" @click.outside="close()">
                <button @click="toggle()" class="relative flex items-center justify-center w-9 h-9 text-gray-400 hover:text-gray-600 dark:text-slate-400 dark:hover:text-white transition-colors rounded-xl hover:bg-gray-100 dark:hover:bg-slate-700" aria-label="Notifications">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <template x-if="unreadCount > 0">
                        <span class="absolute top-1.5 right-1.5 flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-red-500 rounded-full ring-2 ring-white dark:ring-slate-800" x-text="unreadCount > 99 ? '99+' : unreadCount"></span>
                    </template>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-100 dark:border-slate-700 py-2 z-50" @click="close()">
                    <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100 dark:border-slate-700">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Notifikasi</p>
                        <button @click.stop="markAllAsRead()" x-show="unreadCount > 0" class="text-xs theme-text hover:underline font-medium">Tandai semua dibaca</button>
                    </div>
                    <div class="py-2 max-h-80 overflow-y-auto">
                        <template x-if="notifications.length === 0">
                            <p class="px-4 py-6 text-center text-sm text-gray-400 dark:text-slate-500">Tidak ada notifikasi</p>
                        </template>
                        <template x-for="notif in notifications" :key="notif.id">
                            <a :href="notif.data?.url || '#'" @click.stop="markAsRead(notif.id)" class="flex items-start px-4 py-3 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors" :class="!notif.read_at ? 'bg-gray-50 dark:bg-slate-700/30' : ''">
                                <div class="w-8 h-8 rounded-xl theme-bg-light flex items-center justify-center shrink-0 mr-3">
                                    <svg class="w-4 h-4 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900 dark:text-white" x-text="notif.data?.title || 'Notifikasi'"></p>
                                    <p class="text-xs text-gray-500 dark:text-slate-400" x-text="notif.created_at ? new Date(notif.created_at).toLocaleDateString('id-ID', {day:'numeric',month:'short',year:'numeric',hour:'2-digit',minute:'2-digit'}) : ''"></p>
                                </div>
                                <template x-if="!notif.read_at">
                                    <span class="w-2 h-2 rounded-full theme-bg mt-2 shrink-0"></span>
                                </template>
                            </a>
                        </template>
                    </div>
                    <a href="{{ route('admin.notifikasi.index') }}" class="block px-4 py-2.5 text-center text-sm theme-text hover:bg-gray-50 dark:hover:bg-slate-700/50 rounded-b-2xl font-semibold">Lihat Semua</a>
                </div>
            </div>

            <div class="relative" x-data="userDropdown()" @click.outside="close()">
                <button @click="toggle()" class="flex items-center space-x-2 hover:opacity-80 transition-opacity p-1 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-700" aria-label="User menu">
                    <div class="w-8 h-8 rounded-xl flex items-center justify-center theme-bg text-white font-bold text-sm shadow-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="text-left hidden md:block">
                        <p class="font-semibold text-gray-900 dark:text-white text-sm leading-tight truncate max-w-[120px]">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] theme-text">{{ auth()->user()->roles->first()->name ?? 'Administrator' }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-gray-100 dark:border-slate-700 py-1 z-50" @click="close()">
                    <div class="px-4 py-3 border-b border-gray-100 dark:border-slate-700">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                        <svg class="w-4 h-4 mr-3 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>
                    <hr class="my-1 border-gray-100 dark:border-slate-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                            <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
