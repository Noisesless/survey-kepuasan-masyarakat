<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Survey Kepuasan' }}</title>
    
    <!-- Tailwind v4 CDN -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#fdfcfe] text-[#1e1b4b] transition-colors duration-300">

    <!-- Toast Notification Container -->
    <div x-data="toastContainer()" @toast.window="addToast($event.detail)" class="fixed top-4 right-4 z-[1000] flex flex-col gap-2">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.visible" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-8"
                 :class="{
                    'bg-[#1e1b4b] dark:bg-[#d9f99d] dark:text-[#0f1014]': toast.type === 'success',
                    'bg-[#f87171]': toast.type === 'error',
                    'bg-[#fbbf24]': toast.type === 'warning'
                 }"
                 class="px-6 py-3 text-white soft-shadow flex items-center gap-3 sharp min-w-[250px] border border-white/10">
                <i :data-lucide="toast.icon" class="w-5 h-5"></i>
                <span x-text="toast.message" class="text-sm font-bold tracking-tight"></span>
            </div>
        </template>
    </div>

    <!-- Floating Dock Menu (With Auto-Hide on Footer) -->
    <div x-data="{ 
            hideDock: false,
            init() {
                const observer = new IntersectionObserver((entries) => {
                    this.hideDock = entries[0].isIntersecting;
                }, { threshold: 0.1 });
                observer.observe(document.getElementById('main-footer'));
            }
         }">
        <nav x-show="!hideDock"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-20"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-20"
             class="floating-dock fixed bottom-8 left-1/2 -translate-x-1/2 z-[500] flex items-center bg-[#1e1b4b]/90 dark:bg-[#0f1014]/90 backdrop-blur-2xl px-3 py-2 soft-shadow sharp border border-[#d9f99d]/20">
            
            <a href="/" class="p-3 text-[#d9f99d]/60 hover:text-[#d9f99d] transition-all flex flex-col items-center gap-1 group">
                <i data-lucide="home" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="text-[9px] uppercase font-black tracking-widest">Home</span>
            </a>
            
            <div class="w-px h-6 bg-white/10 mx-2"></div>

            @auth
                <a href="/dashboard" class="p-3 text-[#d9f99d]/60 hover:text-[#d9f99d] transition-all flex flex-col items-center gap-1 group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-[9px] uppercase font-black tracking-widest">Admin</span>
                </a>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-3 text-[#d9f99d]/60 hover:text-red-400 transition-all flex flex-col items-center gap-1 group">
                        <i data-lucide="log-out" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-[9px] uppercase font-black tracking-widest">Logout</span>
                    </button>
                </form>
            @else
                <a href="/login" class="p-3 text-[#d9f99d]/60 hover:text-[#d9f99d] transition-all flex flex-col items-center gap-1 group">
                    <i data-lucide="log-in" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-[9px] uppercase font-black tracking-widest">Login</span>
                </a>
            @endauth

            <div class="w-px h-6 bg-white/10 mx-2"></div>

            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-3 text-[#d9f99d]/60 hover:text-[#d9f99d] transition-all flex flex-col items-center gap-1 group">
                <i :data-lucide="darkMode ? 'sun' : 'moon'" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
                <span x-text="darkMode ? 'Light' : 'Dark'" class="text-[9px] uppercase font-black tracking-widest"></span>
            </button>
        </nav>
    </div>

    <!-- Content Area -->
    <main class="min-h-screen pb-20">
        {{ $slot }}
    </main>

    <!-- Simple Footer (Observation Target) -->
    <footer id="main-footer" class="bg-[#1e1b4b] dark:bg-[#0f1014] py-16 border-t border-white/5 text-center relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="w-12 h-1 bg-[#d9f99d] mx-auto mb-8"></div>
            <p class="text-[10px] uppercase font-black tracking-[0.4em] text-[#d9f99d]/40 mb-3">Core Infrastructure</p>
            <p class="text-xs text-white/60">&copy; {{ date('Y') }} {{ config('app.name', 'Survey Kepuasan') }}. Powered by Tech Noir Protocol.</p>
        </div>
    </footer>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Toast Container Logic
        function toastContainer() {
            return {
                toasts: [],
                addToast(detail) {
                    const id = Date.now();
                    const toast = {
                        id,
                        message: detail.message || 'Notifikasi',
                        type: detail.type || 'success',
                        icon: detail.icon || (detail.type === 'success' ? 'check-circle' : 'alert-circle'),
                        visible: true
                    };
                    this.toasts.push(toast);
                    setTimeout(() => {
                        const index = this.toasts.findIndex(t => t.id === id);
                        if (index !== -1) {
                            this.toasts[index].visible = false;
                            setTimeout(() => {
                                this.toasts = this.toasts.filter(t => t.id !== id);
                            }, 300);
                        }
                    }, 3000);
                    // Re-run lucide for new icons
                    setTimeout(() => lucide.createIcons(), 50);
                }
            };
        }
    </script>
</body>
</html>
