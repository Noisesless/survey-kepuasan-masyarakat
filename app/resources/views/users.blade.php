<x-app-layout>
    <x-slot name="title">Manajemen Pengguna</x-slot>

    <div class="p-6 lg:p-12 max-w-6xl mx-auto"
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
            @if(session('error')) 
                $dispatch('toast', { message: '{{ session('error') }}', type: 'error' }); 
            @endif
         ">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Manajemen Pengguna</h1>
                <p class="text-slate-500">Kelola akun administrator dan petugas.</p>
            </div>
            <button @click="$dispatch('open-modal', 'add-user')" class="bg-slate-900 dark:bg-blue-600 text-white px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-slate-800 dark:hover:bg-blue-700 transition-all flex items-center gap-2">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                Tambah User
            </button>
        </div>

        <div class="bg-white dark:bg-slate-900 sharp soft-shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest">Nama</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest">Email</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($users as $user)
                        <tr>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex-center sharp font-bold text-xs uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-sm text-slate-500">{{ $user->email }}</td>
                            <td class="p-4 text-right">
                                <form action="/admin/users/{{ $user->id }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 transition-colors">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User Modal (Simple Alpine.js Modal) -->
        <div x-data="{ open: false }" 
             @open-modal.window="if($event.detail === 'add-user') open = true"
             x-show="open" 
             x-cloak
             class="fixed inset-0 z-[1000] flex-center p-6 bg-slate-900/60 backdrop-blur-sm">
            <div @click.away="open = false" class="w-full max-w-md bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-200 dark:border-slate-700">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold uppercase tracking-widest">Tambah Pengguna</h2>
                    <button @click="open = false" class="text-slate-400 hover:text-slate-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <form action="/admin/users" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required
                               class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-2">Email Address</label>
                        <input type="email" name="email" required
                               class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-50 dark:bg-slate-800 border-b-2 border-slate-200 dark:border-slate-700 px-4 py-3 focus:border-blue-600 outline-none transition-all sharp">
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-4 font-bold uppercase tracking-widest hover:bg-blue-700 transition-all sharp soft-shadow">
                        Simpan User
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
