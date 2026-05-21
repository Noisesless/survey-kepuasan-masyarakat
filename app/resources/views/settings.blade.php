<x-app-layout>
    <x-slot name="title">Pengaturan Aplikasi</x-slot>

    <div class="p-8 lg:p-20 max-w-4xl mx-auto">
        
        <header class="mb-20">
            <h1 class="font-cool text-8xl tracking-tighter text-[#00183e] mb-4">SETTINGS.</h1>
            <p class="font-lemon text-sm text-slate-400 tracking-[0.3em] uppercase">Kelola Identitas Aplikasi</p>
        </header>

        <div class="bg-white p-12 border-4 border-[#00183e] shadow-[20px_20px_0px_#8338ec] sharp">
            <form action="/admin/settings" method="POST" class="space-y-12">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-10">
                        <div>
                            <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Nama Aplikasi</label>
                            <input type="text" name="app_name" value="{{ $settings['app_name'] ?? '' }}"
                                   class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                        </div>
                        <div>
                            <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Deskripsi Meta</label>
                            <textarea name="app_description" rows="3"
                                      class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">{{ $settings['app_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <div>
                            <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Email Instansi</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                   class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                        </div>
                        <div>
                            <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Teks Hak Cipta</label>
                            <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}"
                                   class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#00183e] text-white py-8 font-lemon text-xs uppercase tracking-widest hover:bg-[#8338ec] transition-all sharp">
                    SIMPAN PERUBAHAN
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
