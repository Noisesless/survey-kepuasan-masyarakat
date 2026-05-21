<x-app-layout>
    <x-slot name="title">Pengaturan Aplikasi</x-slot>

    <div class="p-6 lg:p-12 max-w-4xl mx-auto"
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
         ">
        
        <div class="mb-12">
            <h1 class="text-3xl font-bold mb-2">Pengaturan</h1>
            <p class="text-slate-500">Kelola identitas dan konfigurasi aplikasi.</p>
        </div>

        <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-200 dark:border-slate-700">
            <form action="/admin/settings" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-4">Identitas Dasar</label>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Nama Aplikasi</label>
                                <input type="text" name="app_name" value="{{ $settings['app_name'] ?? '' }}"
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Deskripsi Meta (SEO)</label>
                                <textarea name="app_description" rows="3"
                                          class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">{{ $settings['app_description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-4">Kontak & Footer</label>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Email Instansi</label>
                                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Teks Hak Cipta</label>
                                <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}"
                                       class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                    <button type="submit" class="bg-slate-900 dark:bg-blue-600 text-white px-12 py-4 font-bold uppercase tracking-widest hover:bg-slate-800 dark:hover:bg-blue-700 transition-all sharp soft-shadow">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
