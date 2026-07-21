import './bootstrap';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';

window.Alpine = Alpine;
window.Chart = Chart;
window.Cropper = Cropper;

function hexToRgb(hex) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `${r}, ${g}, ${b}`;
}

document.addEventListener('alpine:init', () => {
    Alpine.data('sidebar', () => ({
        collapsed: false,
        mobileOpen: false,
        activeGroup: null,

        get sidebarWidth() {
            return this.collapsed ? 'w-20' : 'w-64';
        },

        desktop: window.innerWidth >= 1024,

        get mainMarginPx() {
            if (!this.desktop) return '0px';
            return this.collapsed ? '80px' : '256px';
        },

        get mainMargin() {
            return this.collapsed ? 'lg:ml-20' : 'lg:ml-64';
        },

        toggleSidebar() {
            if (window.innerWidth >= 1024) {
                this.collapsed = !this.collapsed;
                localStorage.setItem('sidebarCollapsed', this.collapsed);
            } else {
                this.mobileOpen = !this.mobileOpen;
            }
        },

        closeMobile() {
            this.mobileOpen = false;
        },

        init() {
            this.desktop = window.innerWidth >= 1024;
            window.addEventListener('resize', () => {
                this.desktop = window.innerWidth >= 1024;
                if (this.desktop) {
                    this.mobileOpen = false;
                }
            });
        }
    }));

    Alpine.data('darkMode', () => ({
        mode: localStorage.getItem('themeMode') || 'system',
        color: localStorage.getItem('themeColor') || 'sekolah',
        open: false,
        isAdmin: false,

        colors: {
            sekolah: { primary: null, second: null, label: 'Sekolah', hex: null },
            blue:    { primary: '#2563EB', second: '#7C3AED', label: 'Biru', hex: '#2563EB' },
            indigo:  { primary: '#4F46E5', second: '#7C3AED', label: 'Indigo', hex: '#4F46E5' },
            purple:  { primary: '#7C3AED', second: '#EC4899', label: 'Ungu', hex: '#7C3AED' },
            pink:    { primary: '#EC4899', second: '#8B5CF6', label: 'Pink', hex: '#EC4899' },
            red:     { primary: '#DC2626', second: '#F59E0B', label: 'Merah', hex: '#DC2626' },
            orange:  { primary: '#F97316', second: '#EF4444', label: 'Oranye', hex: '#F97316' },
            green:   { primary: '#059669', second: '#0D9488', label: 'Hijau', hex: '#059669' },
            teal:    { primary: '#0D9488', second: '#2563EB', label: 'Tosca', hex: '#0D9488' },
        },

        get isDark() {
            if (this.mode === 'system') {
                return window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
            return this.mode === 'dark';
        },

        init() {
            this.isAdmin = document.documentElement.hasAttribute('data-admin');
            this.applyMode();
            this.applyColor();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (this.mode === 'system') this.applyMode();
            });
        },

        applyMode() {
            document.documentElement.classList.toggle('dark', this.isDark);
        },

        applyColor() {
            const c = this.colors[this.color];
            if (!c || !c.primary) {
                document.documentElement.style.removeProperty('--warna-primary');
                document.documentElement.style.removeProperty('--warna-second');
                document.documentElement.style.removeProperty('--color-primary');
                document.documentElement.style.removeProperty('--color-primary-rgb');
                document.documentElement.style.removeProperty('--color-second');
                document.documentElement.style.removeProperty('--color-second-rgb');
            } else {
                document.documentElement.style.setProperty('--warna-primary', c.primary);
                document.documentElement.style.setProperty('--warna-second', c.second);
                document.documentElement.style.setProperty('--color-primary', c.primary);
                document.documentElement.style.setProperty('--color-primary-rgb', hexToRgb(c.primary));
                document.documentElement.style.setProperty('--color-second', c.second);
                document.documentElement.style.setProperty('--color-second-rgb', hexToRgb(c.second));
            }
        },

        setMode(val) {
            this.mode = val;
            localStorage.setItem('themeMode', val);
            this.applyMode();
        },

        setColor(val) {
            this.color = val;
            localStorage.setItem('themeColor', val);
            this.applyColor();

            const c = this.colors[val];
            if (this.isAdmin && c && c.primary) {
                fetch('/admin/theme', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ warna_primary: c.primary, warna_second: c.second }),
                });
            } else if (this.isAdmin && val === 'sekolah') {
                fetch('/admin/theme', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ warna_primary: '#2563EB', warna_second: '#7C3AED' }),
                });
            }
        },

        modeLabel() {
            return { system: 'Sistem', light: 'Terang', dark: 'Gelap' }[this.mode] || 'Sistem';
        },

        colorLabel() {
            return this.colors[this.color]?.label || 'Sekolah';
        }
    }));

    Alpine.data('themeToggle', () => ({
        mode: localStorage.getItem('themeMode') || 'system',
        open: false,

        get isDark() {
            if (this.mode === 'system') {
                return window.matchMedia('(prefers-color-scheme: dark)').matches;
            }
            return this.mode === 'dark';
        },

        init() {
            this.apply();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (this.mode === 'system') this.apply();
            });
        },

        apply() {
            document.documentElement.classList.toggle('dark', this.isDark);
        },

        setMode(val) {
            this.mode = val;
            localStorage.setItem('themeMode', val);
            this.apply();
            this.open = false;
        }
    }));

    Alpine.data('notificationDropdown', () => ({
        open: false,
        notifications: [],
        unreadCount: 0,
        baseUrl: window.notifBaseUrl || '/admin/notifikasi',

        init() {
            this.fetchNotifications();
            this.fetchUnreadCount();
            setInterval(() => {
                this.fetchUnreadCount();
            }, 30000);
        },

        async fetchNotifications() {
            try {
                const res = await fetch(`${this.baseUrl}/api`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                const data = await res.json();
                this.notifications = data.data || data;
            } catch (e) {}
        },

        async fetchUnreadCount() {
            try {
                const res = await fetch(`${this.baseUrl}/unread-count`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                const data = await res.json();
                this.unreadCount = data.count || 0;
            } catch (e) {}
        },

        async markAsRead(id) {
            try {
                await fetch(`${this.baseUrl}/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                this.fetchNotifications();
                this.fetchUnreadCount();
            } catch (e) {}
        },

        async markAllAsRead() {
            try {
                await fetch(`${this.baseUrl}/read-all`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                this.fetchNotifications();
                this.fetchUnreadCount();
            } catch (e) {}
        },

        toggle() {
            this.open = !this.open;
            if (this.open) this.fetchNotifications();
        },
        close() { this.open = false; }
    }));

    Alpine.data('liveSearch', () => ({
        query: '',
        results: [],
        open: false,
        loading: false,
        debounceTimer: null,

        search() {
            clearTimeout(this.debounceTimer);
            if (this.query.length < 2) {
                this.results = [];
                this.open = false;
                return;
            }
            this.loading = true;
            this.debounceTimer = setTimeout(async () => {
                try {
                    const res = await fetch(`${window.adminSearchUrl}?q=${encodeURIComponent(this.query)}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    this.results = data.results || [];
                    this.open = this.results.length > 0;
                } catch (e) {
                    this.results = [];
                }
                this.loading = false;
            }, 300);
        },

        close() {
            setTimeout(() => { this.open = false; }, 200);
        },

        iconFor(type) {
            const icons = {
                user: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                document: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                megaphone: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>',
                image: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
            };
            return icons[type] || icons.document;
        }
    }));

    Alpine.data('userDropdown', () => ({
        open: false,
        toggle() { this.open = !this.open; },
        close() { this.open = false; }
    }));

    Alpine.data('dashboardGreeting', () => ({
        greeting: '',
        dateStr: '',
        interval: null,

        getGreeting() {
            const hour = new Date().getHours();
            if (hour < 11) return 'Selamat Pagi';
            if (hour < 15) return 'Selamat Siang';
            if (hour < 18) return 'Selamat Sore';
            return 'Selamat Malam';
        },

        getDateStr() {
            return new Date().toLocaleDateString('id-ID', {
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
            });
        },

        startClock() {
            this.greeting = this.getGreeting();
            this.dateStr = this.getDateStr();
            this.interval = setInterval(() => {
                this.greeting = this.getGreeting();
                this.dateStr = this.getDateStr();
            }, 60000);
        },

        destroy() {
            if (this.interval) clearInterval(this.interval);
        }
    }));

    Alpine.data('passwordValidator', () => ({
        password: '',
        get length() { return this.password.length >= 8; },
        get uppercase() { return /[A-Z]/.test(this.password); },
        get number() { return /[0-9]/.test(this.password); },
        get symbol() { return /@/.test(this.password); },
        get valid() { return this.length && this.uppercase && this.number && this.symbol; },
        get strength() {
            let s = 0;
            if (this.length) s++;
            if (this.uppercase) s++;
            if (this.number) s++;
            if (this.symbol) s++;
            return s;
        },
        get strengthLabel() {
            const labels = { 0: '', 1: 'Sangat Lemah', 2: 'Lemah', 3: 'Cukup', 4: 'Kuat' };
            return labels[this.strength] || '';
        },
        get strengthColor() {
            const colors = { 0: 'bg-gray-200', 1: 'bg-red-500', 2: 'bg-orange-500', 3: 'bg-yellow-500', 4: 'bg-green-500' };
            return colors[this.strength] || 'bg-gray-200';
        }
    }));

    Alpine.data('imageCrop', (opts = {}) => ({
        open: false,
        src: '',
        cropper: null,
        inputId: opts.inputId || 'fileInput',
        aspectRatio: opts.aspectRatio || NaN,
        previewId: opts.previewId || null,
        fieldName: opts.fieldName || 'image',

        init() {
            const input = document.getElementById(this.inputId);
            if (input) {
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        this.src = ev.target.result;
                        this.open = true;
                        this.$nextTick(() => this.initCropper());
                    };
                    reader.readAsDataURL(file);
                });
            }
        },

        initCropper() {
            const img = this.$refs.cropImage;
            if (!img) return;
            if (this.cropper) this.cropper.destroy();
            this.cropper = new Cropper(img, {
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
                aspectRatio: this.aspectRatio || NaN,
            });
        },

        crop() {
            const canvas = this.cropper.getCroppedCanvas({ imageSmoothingQuality: 'high' });
            canvas.toBlob((blob) => {
                const file = new File([blob], 'cropped.jpg', { type: 'image/jpeg', lastModified: Date.now() });
                const dt = new DataTransfer();
                dt.items.add(file);
                const input = document.getElementById(this.inputId);
                if (input) {
                    input.files = dt.files;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                }
                if (this.previewId) {
                    const preview = document.getElementById(this.previewId);
                    if (preview) preview.src = canvas.toDataURL('image/jpeg', 0.9);
                }
                this.closeCrop();
            }, 'image/jpeg', 0.92);
        },

        closeCrop() {
            if (this.cropper) { this.cropper.destroy(); this.cropper = null; }
            this.src = '';
            this.open = false;
        }
    }));

    Alpine.data('formValidation', () => ({
        fields: {},

        init() {
            const form = this.$el;
            if (!form || form.tagName !== 'FORM') return;

            form.querySelectorAll('input, textarea, select').forEach(el => {
                const name = el.name;
                if (!name || el.type === 'hidden' || el.type === 'file' || el.type === 'submit') return;

                this.fields[name] = { el, error: '', touched: false };

                el.addEventListener('blur', () => {
                    this.fields[name].touched = true;
                    this.validateField(name);
                });

                el.addEventListener('input', () => {
                    if (this.fields[name].touched) this.validateField(name);
                    this.updateCharCount(el);
                });

                if (el.hasAttribute('maxlength')) this.addCharCount(el);
            });

            form.addEventListener('submit', (e) => {
                let valid = true;
                Object.keys(this.fields).forEach(name => {
                    this.fields[name].touched = true;
                    if (!this.validateField(name)) valid = false;
                });
                if (!valid) {
                    e.preventDefault();
                    const first = form.querySelector('.border-red-500');
                    if (first) first.focus();
                }
            });
        },

        validateField(name) {
            const f = this.fields[name];
            if (!f) return true;
            const el = f.el;
            let msg = '';

            if (el.hasAttribute('required') && !el.value.trim()) {
                msg = 'Wajib diisi.';
            } else if (el.value && el.hasAttribute('maxlength')) {
                const max = parseInt(el.getAttribute('maxlength'));
                if (el.value.length > max) msg = `Maks ${max} karakter.`;
            } else if (el.value && el.hasAttribute('minlength')) {
                const min = parseInt(el.getAttribute('minlength'));
                if (el.value.length < min) msg = `Minimal ${min} karakter.`;
            } else if (el.type === 'email' && el.value) {
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value)) msg = 'Email tidak valid.';
            }

            f.error = msg;
            el.classList.toggle('border-red-500', !!msg);
            el.classList.toggle('dark:border-red-500', !!msg);
            if (!msg) {
                el.classList.add('border-gray-300', 'dark:border-slate-600');
                el.classList.remove('border-gray-200');
            }
            return !msg;
        },

        updateCharCount(el) {
            const max = parseInt(el.getAttribute('maxlength'));
            if (!max) return;
            const ct = el.parentNode?.querySelector('.char-count');
            if (!ct) return;
            const len = el.value.length;
            ct.textContent = `${len}/${max}`;
            ct.classList.toggle('text-red-500', len >= max);
            ct.classList.toggle('text-gray-400', len < max);
        },

        addCharCount(el) {
            const max = parseInt(el.getAttribute('maxlength'));
            if (!max || el.parentNode.querySelector('.char-count')) return;
            const ct = document.createElement('span');
            ct.className = 'char-count text-[10px] text-gray-400 dark:text-slate-500 float-right mt-0.5';
            ct.textContent = `0/${max}`;
            el.parentNode.appendChild(ct);
        },
    }));
});

Alpine.start();

// Scroll reveal
document.addEventListener('DOMContentLoaded', () => {
    const reveals = document.querySelectorAll('.reveal');
    if (reveals.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        reveals.forEach(el => observer.observe(el));
    }

    const counters = document.querySelectorAll('[data-count-to]');
    if (counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCount(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        counters.forEach(el => counterObserver.observe(el));
    }
});

function animateCount(el) {
    const target = parseInt(el.getAttribute('data-count-to'), 10);
    if (isNaN(target)) return;
    const duration = 1500;
    const start = performance.now();
    const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.floor(eased * target).toLocaleString('id-ID');
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString('id-ID');
    };
    requestAnimationFrame(step);
}
