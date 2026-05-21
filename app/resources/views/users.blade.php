<x-app-layout>
    <x-slot name="title">Manajemen Pengguna</x-slot>

    <div class="p-8 lg:p-20 max-w-6xl mx-auto">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-20 gap-6">
            <div>
                <h1 class="font-cool text-8xl tracking-tighter text-[#00183e] mb-4">USERS.</h1>
                <p class="font-lemon text-sm text-slate-400 tracking-[0.3em] uppercase">Kelola Akun Administrator</p>
            </div>
            <button @click="$dispatch('open-modal', 'add-user')" class="bg-[#00183e] text-white px-8 py-5 font-lemon text-xs uppercase tracking-widest sharp shadow-[8px_8px_0px_#8338ec] hover:bg-[#ff006e] transition-all">
                TAMBAH USER
            </button>
        </header>

        <div class="bg-white border-4 border-[#00183e] shadow-[15px_15px_0px_#fb5607] sharp overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#f7f7fb] border-b-4 border-[#00183e]">
                        <th class="p-6 font-lemon text-[10px] tracking-widest uppercase">Nama</th>
                        <th class="p-6 font-lemon text-[10px] tracking-widest uppercase">Email</th>
                        <th class="p-6 font-lemon text-[10px] tracking-widest uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-4 divide-[#00183e]/10">
                    @foreach($users as $user)
                        <tr class="hover:bg-[#f7f7fb] transition-colors">
                            <td class="p-6">
                                <div class="flex items-center gap-6">
                                    <div class="w-12 h-12 bg-[#3a86ff] text-white flex-center font-cool text-xl sharp">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-cool text-lg font-bold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="p-6 font-bold text-slate-500">{{ $user->email }}</td>
                            <td class="p-6 text-right">
                                <form action="/admin/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#ff006e] hover:text-[#00183e] p-2 transition-colors">
                                        <i data-lucide="trash-2" class="w-6 h-6"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User Modal -->
        <div x-data="{ open: false }" 
             @open-modal.window="if($event.detail === 'add-user') open = true"
             x-show="open" 
             x-cloak
             class="fixed inset-0 z-[1000] flex-center p-6 bg-[#00183e]/80 backdrop-blur-sm">
            <div @click.away="open = false" class="w-full max-w-md bg-white p-10 border-4 border-[#00183e] shadow-[20px_20px_0px_#8338ec] sharp">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="font-cool text-4xl">TAMBAH USER</h2>
                    <button @click="open = false" class="text-slate-400 hover:text-[#ff006e]">
                        <i data-lucide="x" class="w-8 h-8"></i>
                    </button>
                </div>

                <form action="/admin/users" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                    </div>
                    <div>
                        <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Email Address</label>
                        <input type="email" name="email" required class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                    </div>
                    <div>
                        <label class="font-lemon text-[10px] text-slate-400 uppercase tracking-widest mb-3 block">Password</label>
                        <input type="password" name="password" required class="w-full bg-[#f7f7fb] border-b-4 border-[#00183e] py-4 px-2 focus:border-[#3a86ff] outline-none transition-all font-bold text-lg">
                    </div>
                    <button type="submit" class="w-full bg-[#00183e] text-white py-6 font-lemon text-xs uppercase tracking-widest hover:bg-[#8338ec] transition-all sharp">
                        SIMPAN PENGGUNA
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
