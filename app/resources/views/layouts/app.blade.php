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
<body class="bg-gray-50 text-slate-800 transition-colors duration-300">

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
                    'bg-green-600': toast.type === 'success',
                    'bg-red-600': toast.type === 'error',
                    'bg-amber-500': toast.type === 'warning'
                 }"
                 class="px-6 py-3 text-white soft-shadow flex items-center gap-3 sharp min-w-[250px]">
                <i :data-lucide="toast.icon" class="w-5 h-5"></i>
                <span x-text="toast.message" class="text-sm font-semibold"></span>
            </div>
        </template>
    </div>

    <!-- Floating Dock Menu -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[500] flex items-center bg-white/80 dark:bg-slate-900/80 backdrop-blur-md px-2 py-2 soft-shadow sharp border border-slate-200 dark:border-slate-700">
        <a href="/" class="p-3 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex flex-col items-center gap-1">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span class="text-[10px] uppercase font-bold tracking-wider">Home</span>
        </a>
        
        <div class="w-px h-8 bg-slate-200 dark:bg-slate-700 mx-1"></div>

        @auth
            <a href="/dashboard" class="p-3 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex flex-col items-center gap-1">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="text-[10px] uppercase font-bold tracking-wider">Admin</span>
            </a>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="p-3 text-slate-600 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition-colors flex flex-col items-center gap-1">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="text-[10px] uppercase font-bold tracking-wider">Logout</span>
                </button>
            </form>
        @else
            <a href="/login" class="p-3 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors flex flex-col items-center gap-1">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                <span class="text-[10px] uppercase font-bold tracking-wider">Login</span>
            </a>
        @endauth

        <div class="w-px h-8 bg-slate-200 dark:bg-slate-700 mx-1"></div>

        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-3 text-slate-600 dark:text-slate-400 hover:text-amber-500 transition-colors flex flex-col items-center gap-1">
            <i :data-lucide="darkMode ? 'sun' : 'moon'" class="w-5 h-5"></i>
            <span x-text="darkMode ? 'Light' : 'Dark'" class="text-[10px] uppercase font-bold tracking-wider"></span>
        </button>
    </nav>

    <!-- Content Area -->
    <main class="min-h-screen pb-32">
        {{ $slot }}
    </main>

    <!-- Floating Back to Top -->
    <button x-data="{ show: false }" 
            @scroll.window="show = window.pageYOffset > 400"
            x-show="show"
            x-cloak
            x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-24 right-6 p-3 bg-blue-600 text-white soft-shadow sharp hover:bg-blue-700 transition-all z-[400]"
            id="backToTop">
        <i data-lucide="arrow-up" class="w-6 h-6"></i>
    </button>

    <!-- Simple Footer -->
    <footer class="bg-white dark:bg-slate-900 py-8 border-t border-slate-200 dark:border-slate-800 text-center text-sm text-slate-500">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Survey Kepuasan') }}. All rights reserved.</p>
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
