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
        collapsed: localStorage.getItem('sidebarCollapsed') === 'true',
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
