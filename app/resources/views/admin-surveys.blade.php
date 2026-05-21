<x-app-layout>
    <x-slot name="title">Daftar Survey</x-slot>

    <div class="p-6 lg:p-12 max-w-7xl mx-auto"
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
         ">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Data Survey</h1>
                <p class="text-slate-500">Seluruh penilaian dari responden.</p>
            </div>
            <a href="/admin/export" class="bg-emerald-600 text-white px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-emerald-700 transition-all flex items-center gap-2">
                <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                Export Excel (CSV)
            </a>
        </div>

        <div class="bg-white dark:bg-slate-900 sharp soft-shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest">Waktu</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest">Nama</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest text-center">Skor</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest">Komentar</th>
                        <th class="p-4 font-bold uppercase text-[10px] tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($surveys as $survey)
                        <tr>
                            <td class="p-4 text-xs text-slate-500">{{ $survey->created_at->format('d/m/Y H:i') }}</td>
                            <td class="p-4 font-semibold">{{ $survey->nama }}</td>
                            <td class="p-4 text-center">
                                <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 text-xs font-bold sharp">
                                    {{ $survey->skor }}
                                </span>
                            </td>
                            <td class="p-4 text-sm text-slate-600 dark:text-slate-400 max-w-xs truncate">{{ $survey->komentar }}</td>
                            <td class="p-4 text-right">
                                <form action="/admin/surveys/{{ $survey->id }}" method="POST" onsubmit="return confirm('Hapus data survey ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 transition-colors">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-slate-400 italic">Belum ada data survey.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $surveys->links() }}
        </div>
    </div>
</x-app-layout>
