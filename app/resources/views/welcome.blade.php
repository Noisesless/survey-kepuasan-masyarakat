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
            <!-- Left Side: Image/Visual (Midnight Plum) -->
            <div class="lg:w-1/2 bg-[#1e1b4b] flex-center p-12 relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <path d="M0 100 C 20 0 50 0 100 100 Z" fill="#d9f99d"></path>
                    </svg>
                </div>
                <div class="relative z-10 text-white text-center lg:text-left">
                    <h1 class="text-6xl font-black mb-6 leading-none tracking-tighter text-white">VOICE OF <br> <span class="text-[#d9f99d]">PROGRESS.</span></h1>
                    <p class="text-lg opacity-60 mb-10 max-w-md font-medium leading-relaxed">Help us redefine public service quality through your honest feedback. It takes only 60 seconds.</p>
                    <div class="flex gap-6 justify-center lg:justify-start">
                        <div class="flex flex-col">
                            <span class="text-3xl font-black text-[#d9f99d]">100%</span>
                            <span class="text-[9px] uppercase font-black tracking-[0.2em] opacity-40">Anonymous</span>
                        </div>
                        <div class="w-px h-10 bg-white/10"></div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-black text-[#d9f99d]">REAL</span>
                            <span class="text-[9px] uppercase font-black tracking-[0.2em] opacity-40">Impact</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form (Restorative Neutral) -->
            <div class="lg:w-1/2 bg-[#fdfcfe] dark:bg-slate-950 flex items-center justify-center p-6 lg:p-12">
                <div class="w-full max-w-md bg-white dark:bg-slate-900 p-10 soft-shadow sharp border border-slate-100 dark:border-slate-800">
                    <div class="mb-10">
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-2">Service Survey</h2>
                        <h3 class="text-3xl font-black tracking-tighter">Your feedback matters.</h3>
                    </div>

                    <form action="/survey" method="POST" class="space-y-8">
                        @csrf
                        
                        <div class="group">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 group-focus-within:text-lime-500 transition-colors mb-2">Full Name</label>
                            <input type="text" name="nama" required value="{{ old('nama') }}"
                                   class="w-full bg-transparent border-b-2 border-slate-100 dark:border-slate-800 px-0 py-3 focus:border-lime-400 outline-none transition-all sharp font-bold text-lg">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Satisfaction Level</label>
                            <div class="flex justify-between gap-3">
                                <template x-for="i in 5">
                                    <label class="flex-1">
                                        <input type="radio" name="skor" :value="i" required class="hidden peer" {{ old('skor') == 5 ? 'checked' : '' }}>
                                        <div class="cursor-pointer text-center py-4 border-2 border-slate-100 dark:border-slate-800 peer-checked:border-lime-400 peer-checked:bg-lime-50 dark:peer-checked:bg-lime-900/10 transition-all sharp group">
                                            <span class="block text-xl font-black group-hover:scale-110 transition-transform" x-text="i"></span>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 group-focus-within:text-lime-500 transition-colors mb-2">Detailed Comments</label>
                            <textarea name="komentar" rows="2"
                                      class="w-full bg-transparent border-b-2 border-slate-100 dark:border-slate-800 px-0 py-3 focus:border-lime-400 outline-none transition-all sharp font-medium">{{ old('komentar') }}</textarea>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Security Verification</label>
                            <div class="flex items-center gap-4">
                                <div class="bg-slate-50 dark:bg-slate-800 p-2 border border-slate-100 dark:border-slate-800">
                                    <img :src="captchaUrl" alt="Captcha" class="h-8 contrast-125">
                                </div>
                                <button type="button" @click="refreshCaptcha()" class="p-2 text-slate-400 hover:text-lime-500 transition-colors">
                                    <i data-lucide="rotate-cw" class="w-5 h-5"></i>
                                </button>
                                <input type="text" name="captcha" required placeholder="Type code"
                                       class="flex-1 bg-transparent border-b-2 border-slate-100 dark:border-slate-800 px-0 py-2 focus:border-lime-400 outline-none transition-all sharp font-bold">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-slate-950 dark:bg-lime-400 text-white dark:text-slate-950 py-5 font-black uppercase tracking-[0.2em] text-xs hover:bg-slate-800 dark:hover:bg-lime-300 transition-all sharp soft-shadow">
                            Submit Response
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
