<x-app-layout>
    <x-slot name="title">{{ $appName }}</x-slot>

    <div x-data="{ 
            captchaUrl: '/captcha', 
            refreshCaptcha() { this.captchaUrl = '/captcha?v=' + Date.now() } 
         }" 
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
            @if(session('error')) 
                $dispatch('toast', { message: '{{ session('error') }}', type: 'error' }); 
            @endif
         ">
        
        <!-- Hero Split Screen -->
        <div class="flex flex-col lg:flex-row min-h-[90vh]">
            <!-- Left Side: Image/Visual -->
            <div class="lg:w-1/2 bg-blue-600 flex-center p-12 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
                    </svg>
                </div>
                <div class="relative z-10 text-white text-center lg:text-left">
                    <h1 class="text-5xl font-bold mb-6 leading-tight">Suara Anda Adalah <br> Kemajuan Kami.</h1>
                    <p class="text-xl opacity-90 mb-8 max-w-lg">Bantu kami meningkatkan kualitas layanan publik dengan memberikan penilaian jujur Anda. Hanya butuh 1 menit.</p>
                    <div class="flex gap-4 justify-center lg:justify-start">
                        <div class="bg-white/10 p-4 sharp border border-white/20 backdrop-blur-sm">
                            <span class="block text-2xl font-bold">100%</span>
                            <span class="text-xs uppercase opacity-70">Anonim</span>
                        </div>
                        <div class="bg-white/10 p-4 sharp border border-white/20 backdrop-blur-sm">
                            <span class="block text-2xl font-bold">Fast</span>
                            <span class="text-xs uppercase opacity-70">Response</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="lg:w-1/2 bg-gray-50 dark:bg-slate-800 flex items-center justify-center p-6 lg:p-12">
                <div class="w-full max-w-md bg-white dark:bg-slate-900 p-8 soft-shadow sharp border border-slate-200 dark:border-slate-700">
                    <h2 class="text-2xl font-bold mb-2">Isi Survey</h2>
                    <p class="text-sm text-slate-500 mb-8">Silakan lengkapi formulir di bawah ini.</p>

                    <form action="/survey" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" required value="{{ old('nama') }}"
                                   class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-4">Seberapa Puas Anda?</label>
                            <div class="flex justify-between gap-2">
                                <template x-for="i in 5">
                                    <label class="flex-1">
                                        <input type="radio" name="skor" :value="i" required class="hidden peer" {{ old('skor') == 5 ? 'checked' : '' }}>
                                        <div class="cursor-pointer text-center py-3 border-2 border-slate-200 dark:border-slate-700 peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 transition-all sharp">
                                            <span class="block text-lg font-bold" x-text="i"></span>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Komentar / Saran</label>
                            <textarea name="komentar" rows="3"
                                      class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">{{ old('komentar') }}</textarea>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-xs font-bold uppercase tracking-widest mb-2">Verifikasi Keamanan</label>
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-1 border border-slate-200 dark:border-slate-700 flex-center">
                                    <img :src="captchaUrl" alt="Captcha" class="h-10">
                                </div>
                                <button type="button" @click="refreshCaptcha()" class="p-2 text-slate-500 hover:text-blue-600 transition-colors">
                                    <i data-lucide="rotate-cw" class="w-5 h-5"></i>
                                </button>
                                <input type="text" name="captcha" required placeholder="Teks Captcha"
                                       class="flex-1 bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-2 focus:border-blue-600 outline-none transition-all sharp">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-blue-700 transition-all sharp soft-shadow">
                            Kirim Penilaian
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
