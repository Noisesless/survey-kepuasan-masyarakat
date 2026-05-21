<x-app-layout>
    <x-slot name="title">Login Admin</x-slot>

    <div class="fixed inset-0 w-full h-full flex items-center justify-center p-8 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');">
        
        <!-- Overlay Layer -->
        <div class="absolute inset-0 bg-[#00183e]/80"></div>

        <div class="w-full max-w-lg bg-white p-12 border-4 border-[#00183e] shadow-[20px_20px_0px_#ff006e] sharp relative z-10">
            <div class="text-center mb-16">
                <div class="w-24 h-24 bg-[#00183e] text-white flex items-center justify-center mx-auto mb-10 sharp shadow-[10px_10px_0px_#8338ec]">
                    <i data-lucide="lock" class="w-12 h-12"></i>
                </div>
                <h2 class="font-cool text-6xl tracking-tighter">ADMIN LOGIN</h2>
                <p class="font-lemon text-xs text-slate-400 tracking-[0.3em] uppercase mt-4">Sistem Autentikasi Pengelola</p>
            </div>

            <form action="/login" method="POST" class="space-y-10">
                @csrf
                
                <div>
                    <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                </div>

                <div>
                    <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Password</label>
                    <input type="password" name="password" required
                           class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                </div>

                <button type="submit" class="w-full bg-[#00183e] text-white py-8 font-lemon text-xs uppercase tracking-widest hover:bg-[#8338ec] transition-all sharp">
                    MASUK SEKARANG
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
