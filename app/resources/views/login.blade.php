<x-app-layout>
    <x-slot name="title">Login Admin</x-slot>

    <div class="min-h-[80vh] flex-center p-6"
         x-init="
            @if(session('error')) 
                $dispatch('toast', { message: '{{ session('error') }}', type: 'error' }); 
            @endif
         ">
        <div class="w-full max-w-sm bg-white dark:bg-slate-900 p-8 soft-shadow sharp border border-slate-200 dark:border-slate-700">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-blue-600 text-white flex-center mx-auto mb-4 sharp soft-shadow">
                    <i data-lucide="lock" class="w-8 h-8"></i>
                </div>
                <h2 class="text-2xl font-bold">Admin Panel</h2>
                <p class="text-sm text-slate-500">Masuk untuk mengelola survey</p>
            </div>

            <form action="/login" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest mb-2">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 sharp">
                        <span class="text-xs text-slate-600 dark:text-slate-400">Ingat Saya</span>
                    </label>
                    <a href="/" class="text-xs text-blue-600 hover:underline">Kembali ke Beranda</a>
                </div>

                <button type="submit" class="w-full bg-slate-900 dark:bg-blue-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-slate-800 dark:hover:bg-blue-700 transition-all sharp soft-shadow">
                    Masuk Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
