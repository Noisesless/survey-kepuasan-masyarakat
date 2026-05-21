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
        
        <!-- Section 1: Hero (Hyper-Impact) -->
        <section class="relative min-h-screen flex items-center pt-20 border-b-[16px] border-[#ff006e] bg-[#f7f7fb] overflow-hidden">
            <div class="absolute right-0 top-0 w-2/3 h-full mobile-hide">
                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=2074&auto=format&fit=crop" 
                     alt="Public Service" 
                     class="w-full h-full object-cover grayscale contrast-125 opacity-10">
                <div class="absolute inset-0 bg-gradient-to-l from-transparent to-[#f7f7fb]"></div>
            </div>

            <div class="max-w-7xl mx-auto px-8 w-full relative z-10">
                <div class="inline-block bg-[#8338ec] text-white px-6 py-2 mb-10 font-lemon text-sm sharp shadow-[10px_10px_0px_#00183e]">PLATFORM TERBUKA</div>
                <h1 class="font-cool text-[#00183e] mb-12">
                    <span class="block text-8xl md:text-9xl">SUARA ANDA</span>
                    <span class="block text-[#ff006e] -mt-6">MENGUBAH</span>
                    <span class="block text-[#ffbe0b] drop-shadow-[6px_6px_0px_#00183e]">DUNIA.</span>
                </h1>
                
                <div class="flex flex-wrap gap-8 items-center">
                    <p class="max-w-md text-2xl font-bold leading-tight text-[#00183e]/80">Partisipasi aktif Anda adalah kunci evolusi kualitas layanan publik nasional.</p>
                    <a href="#survey-form" class="bg-[#00183e] text-white px-10 py-6 font-lemon text-lg sharp hyper-shadow hover:bg-[#ff006e] hover:shadow-[12px_12px_0px_#ffbe0b] transition-all transform hover:-translate-y-1">MULAI SURVEY ↓</a>
                </div>

                <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="p-8 border-4 border-[#00183e] bg-[#f7f7fb] shadow-[10px_10px_0px_#3a86ff] sharp">
                        <span class="font-cool text-5xl text-[#ff006e] block mb-2">100%</span>
                        <span class="font-lemon text-xs text-[#00183e]">RAHASIA TERJAMIN</span>
                    </div>
                    <div class="p-8 border-4 border-[#00183e] bg-[#f7f7fb] shadow-[10px_10px_0px_#ffbe0b] sharp">
                        <span class="font-cool text-5xl text-[#fb5607] block mb-2">FAST</span>
                        <span class="font-lemon text-xs text-[#00183e]">RESPONS DINAMIS</span>
                    </div>
                    <div class="p-8 border-4 border-[#00183e] bg-[#f7f7fb] shadow-[10px_10px_0px_#8338ec] sharp">
                        <span class="font-cool text-5xl text-[#3a86ff] block mb-2">REAL</span>
                        <span class="font-lemon text-xs text-[#00183e]">DAMPAK NYATA</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Split Content (Visual + Form) -->
        <section id="survey-form" class="flex flex-col lg:flex-row bg-[#f7f7fb]">
            <div class="lg:w-5/12 bg-[#00183e] p-20 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute inset-0 opacity-40">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop" 
                         class="w-full h-full object-cover">
                </div>
                <div class="relative z-10">
                    <h2 class="font-cool text-7xl text-[#d9f99d] mb-10 leading-none">BERIKAN<br>YANG<br>TERBAIK.</h2>
                    <div class="w-32 h-4 bg-[#ff006e] mb-10"></div>
                    <p class="text-white/60 font-bold text-xl max-w-xs">Penilaian Anda dikonversi menjadi data strategis untuk perbaikan berkelanjutan.</p>
                </div>
                <div class="relative z-10 mt-20">
                    <div class="p-8 bg-[#ffbe0b] border-4 border-white sharp shadow-[10px_10px_0px_#ff006e]">
                        <p class="text-[#352700] font-black leading-tight italic text-lg">"Pelayanan publik yang hebat lahir dari masyarakat yang berani bersuara."</p>
                    </div>
                </div>
            </div>

            <div class="lg:w-7/12 bg-[#f7f7fb] p-8 lg:p-24 flex items-center justify-center">
                <div class="w-full max-w-2xl">
                    <div class="mb-20">
                        <span class="font-lemon text-[#ff006e] text-sm tracking-[0.5em] block mb-4">INSTRUMEN PENILAIAN</span>
                        <h3 class="font-cool text-6xl text-[#00183e] tracking-tighter">Lembar Survey SKM.</h3>
                        <div class="mt-8 p-6 bg-[#ffbe0b] border-4 border-[#00183e] shadow-[12px_12px_0px_#00183e] sharp">
                            <p class="text-[#352700] font-black flex items-center gap-4">
                                <i data-lucide="info" class="w-8 h-8"></i>
                                <span>PANDUAN: Semakin memuaskan pelayanan yang Anda rasakan, berikan nilai yang semakin tinggi (Skala 1 - 5).</span>
                            </p>
                        </div>
                    </div>

                    <form action="/survey" method="POST" class="space-y-24">
                        @csrf
                        
                        <div class="group relative">
                            <label class="font-lemon text-xs text-slate-400 group-focus-within:text-[#ff006e] transition-colors absolute -top-8 left-0">Identitas Responden</label>
                            <input type="text" name="nama" required value="{{ old('nama') }}" placeholder="Nama Lengkap / Inisial"
                                   class="w-full bg-transparent border-b-[6px] border-[#00183e] py-6 focus:border-[#ff006e] outline-none transition-all font-cool text-4xl text-[#00183e] placeholder:text-slate-200">
                        </div>

                        <div class="space-y-32">
                            @php 
                                $colors = ['#ff006e', '#fb5607', '#ffbe0b', '#8338ec', '#3a86ff']; 
                            @endphp
                            @foreach($questions as $key => $question)
                                @php $activeColor = $colors[$loop->index % count($colors)]; @endphp
                                <div class="group relative">
                                    <div class="flex items-start gap-8 mb-12">
                                        <span class="flex-none w-16 h-16 bg-[{{ $activeColor }}] text-white font-cool text-4xl flex-center sharp shadow-[6px_6px_0px_#00183e]">{{ $loop->iteration }}</span>
                                        <label class="font-lemon text-xl leading-tight text-[#00183e] pt-2">{{ $question }}</label>
                                    </div>
                                    
                                    <div class="grid grid-cols-5 gap-4 lg:gap-8">
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="relative cursor-pointer group/item">
                                                <input type="radio" name="{{ $key }}" value="{{ $i }}" required class="hidden peer" {{ old($key) == $i ? 'checked' : '' }}>
                                                <div class="h-24 flex-center border-4 border-[#00183e] bg-[#f7f7fb] transition-all duration-300 sharp 
                                                            peer-checked:bg-[{{ $activeColor }}] peer-checked:border-[{{ $activeColor }}] peer-checked:text-white 
                                                            peer-checked:shadow-[10px_10px_0px_#00183e] peer-checked:-translate-y-2
                                                            group-hover/item:border-[{{ $activeColor }}]">
                                                    <span class="font-cool text-4xl">{{ $i }}</span>
                                                </div>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="group relative pt-10">
                            <label class="font-lemon text-xs text-slate-400 group-focus-within:text-[#8338ec] transition-colors absolute -top-2 left-0">Saran & Masukan Konstruktif</label>
                            <textarea name="komentar" rows="4" placeholder="Tuliskan pendapat Anda di sini..."
                                      class="w-full bg-[#f7f7fb] border-4 border-[#00183e] p-8 focus:border-[#8338ec] outline-none transition-all font-bold text-xl text-[#00183e] shadow-[10px_10px_0px_#00183e] sharp">{{ old('komentar') }}</textarea>
                        </div>

                        <div class="p-10 border-4 border-[#00183e] bg-[#f7f7fb] shadow-[15px_15px_0px_#fb5607] sharp">
                            <label class="font-lemon text-xs text-[#00183e] mb-8 block">VERIFIKASI MANUSIA</label>
                            <div class="flex flex-col md:flex-row items-center gap-10">
                                <div class="bg-[#00183e] p-6 border-4 border-[#ffbe0b] sharp shadow-[10px_10px_0px_#ff006e] flex-center min-w-[200px]">
                                    <img :src="captchaUrl" alt="Captcha" class="h-12 invert contrast-200 brightness-200">
                                </div>
                                <div class="flex gap-4 w-full">
                                    <button type="button" @click="refreshCaptcha()" class="p-6 bg-[#00183e] text-white hover:bg-[#ff006e] border-4 border-[#00183e] transition-all sharp shadow-[6px_6px_0px_#00183e]">
                                        <i data-lucide="rotate-cw" class="w-8 h-8"></i>
                                    </button>
                                    <input type="text" name="captcha" required placeholder="Masukan Kode"
                                           class="w-full bg-transparent border-b-8 border-[#00183e] px-4 py-4 focus:border-[#ff006e] outline-none transition-all font-cool text-4xl text-[#00183e]">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="group w-full bg-[#00183e] text-white py-10 sharp border-[6px] border-[#00183e] transition-all hover:bg-[#ff006e] hover:shadow-[20px_20px_0px_#ffbe0b] active:scale-95 overflow-hidden relative">
                            <span class="relative z-10 font-cool text-4xl tracking-tighter">KIRIM PENILAIAN SEKARANG</span>
                            <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                        </button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
