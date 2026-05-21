<!DOCTYPE html>
<html lang="id" class="light">
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
        
        /* Simulated Lemon Milk */
        .font-lemon {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.15em !important;
        }

        /* Simulated Coolvetica */
        .font-cool {
            font-family: 'Inter', sans-serif !important;
            font-weight: 900 !important;
            letter-spacing: -0.06em !important;
            line-height: 0.8 !important;
        }

        .bg-vibrant-gradient {
            background: linear-gradient(135deg, #8338ec 0%, #3a86ff 100%);
        }
    </style>
</head>
<body class="bg-[#f7f7fb] text-[#00183e] transition-colors duration-500 overflow-x-hidden selection:bg-[#ff006e] selection:text-white">

    <!-- Toast Notification Container -->
    <div x-data="toastContainer()" @toast.window="addToast($event.detail)" class="fixed top-8 right-8 z-[1000] flex flex-col gap-4">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.visible" 
                 x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
                 x-transition:enter-start="opacity-0 scale-50 translate-x-20"
                 x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-50 translate-x-20"
                 :class="{
                    'bg-[#8338ec]': toast.type === 'success',
                    'bg-[#ff006e]': toast.type === 'error',
                    'bg-[#ffbe0b] text-[#352700]': toast.type === 'warning'
                 }"
                 class="px-10 py-6 hyper-shadow flex items-center gap-6 sharp border-4 border-[#00183e] text-white">
                <i :data-lucide="toast.icon" class="w-8 h-8"></i>
                <span x-text="toast.message" class="text-lg font-black uppercase tracking-tight"></span>
            </div>
        </template>
    </div>

    <!-- Hyper-Modern Navigation (Circular Top-Left) -->
    <div x-data="{ open: false }"
         class="fixed top-8 left-8 z-[600]">
        
        <!-- Trigger Button -->
        <button @click="open = !open"
                class="w-20 h-20 bg-white border-[6px] border-[#00183e] rounded-full flex-center shadow-[8px_8px_0px_#00183e] hover:rotate-180 transition-transform duration-500">
            <i data-lucide="menu" class="w-8 h-8 text-[#00183e]"></i>
        </button>

        <!-- Circular Menu Panel (Rounded) -->
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-50"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-50"
             class="absolute top-24 left-0 w-64 bg-white border-[6px] border-[#00183e] rounded-[32px] shadow-[15px_15px_0px_#8338ec] p-6 flex flex-col gap-2">
            
            <a href="/" class="p-4 text-[#00183e] hover:bg-[#ffbe0b] rounded-2xl hover:font-black transition-all flex items-center gap-4 group">
                <i data-lucide="home" class="w-6 h-6"></i>
                <span class="font-lemon text-xs">BERANDA</span>
            </a>
            
            @auth
                <a href="/dashboard" class="p-4 text-[#00183e] hover:bg-[#3a86ff] hover:text-white rounded-2xl transition-all flex items-center gap-4 group">
                    <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                    <span class="font-lemon text-xs">DASHBOARD</span>
                </a>
                <form action="/logout" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full p-4 text-[#00183e] hover:bg-[#ff006e] hover:text-white rounded-2xl transition-all flex items-center gap-4 group">
                        <i data-lucide="log-out" class="w-6 h-6"></i>
                        <span class="font-lemon text-xs">EXIT</span>
                    </button>
                </form>
            @else
                <a href="/login" class="p-4 text-[#00183e] hover:bg-[#3a86ff] hover:text-white rounded-2xl transition-all flex items-center gap-4 group">
                    <i data-lucide="log-in" class="w-6 h-6"></i>
                    <span class="font-lemon text-xs">LOGIN</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- Floating Back to Top (Circle) -->
    <button x-data="{ show: false }" 
            @scroll.window="show = window.pageYOffset > 500"
            x-show="show"
            x-cloak
            x-transition
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-10 right-10 w-16 h-16 bg-[#ff006e] rounded-full flex-center border-4 border-[#00183e] shadow-[6px_6px_0px_#00183e] z-[500] hover:scale-110 transition-transform">
        <i data-lucide="arrow-up" class="w-8 h-8 text-white"></i>
    </button>

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Hyper-Modern Footer -->
    <footer id="main-footer" class="bg-[#00183e] py-32 text-center relative z-10 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <h1 class="font-cool text-[20vw] text-white whitespace-nowrap -translate-x-1/4">SISTEM SURVEY • SISTEM SURVEY • </h1>
        </div>
        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="flex justify-center gap-8 mb-16">
                <div class="w-20 h-20 bg-[#ff006e] sharp border-4 border-white shadow-[10px_10px_0px_#8338ec] rotate-3 hover:rotate-0 transition-transform"></div>
                <div class="w-20 h-20 bg-[#ffbe0b] sharp border-4 border-white shadow-[10px_10px_0px_#fb5607] -rotate-6 hover:rotate-0 transition-transform"></div>
                <div class="w-20 h-20 bg-[#3a86ff] sharp border-4 border-white shadow-[10px_10px_0px_#ff006e] rotate-12 hover:rotate-0 transition-transform"></div>
            </div>
            <p class="font-lemon text-xl tracking-[0.6em] text-[#ffbe0b] mb-6">INTEGRITAS LAYANAN PUBLIK</p>
            <p class="text-lg font-bold text-white/40">&copy; {{ date('Y') }} {{ config('app.name', 'Survey Kepuasan') }}. Built with Hyper-Modern Architecture.</p>
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
                            }, 500);
                        }
                    }, 4000);
                    setTimeout(() => lucide.createIcons(), 50);
                }
            };
        }
    </script>
</body>
</html>
