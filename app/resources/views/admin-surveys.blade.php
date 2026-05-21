<x-app-layout>
    <x-slot name="title">Daftar Survey</x-slot>

    <div class="p-8 lg:p-20 max-w-7xl mx-auto">
        
        <header class="mb-20">
            <h1 class="font-cool text-8xl tracking-tighter text-[#00183e] mb-4">DATA SURVEY.</h1>
            <p class="font-lemon text-sm text-slate-400 tracking-[0.3em] uppercase">Seluruh Penilaian Responden</p>
        </header>

        <div class="bg-white border-4 border-[#00183e] shadow-[15px_15px_0px_#8338ec] sharp overflow-x-auto">
            <table class="w-full text-left min-w-[1000px]">
                <thead>
                    <tr class="bg-[#f7f7fb] border-b-4 border-[#00183e]">
                        <th class="p-6 font-lemon text-[10px] tracking-widest uppercase">Waktu</th>
                        <th class="p-6 font-lemon text-[10px] tracking-widest uppercase">Nama</th>
                        @for($i=1; $i<=9; $i++)
                            <th class="p-4 font-lemon text-[10px] tracking-widest text-center">Q{{ $i }}</th>
                        @endfor
                        <th class="p-6 font-lemon text-[10px] tracking-widest text-center">AVG</th>
                        <th class="p-6 font-lemon text-[10px] tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y-4 divide-[#00183e]/10">
                    @forelse($surveys as $survey)
                        <tr class="hover:bg-[#f7f7fb] transition-colors">
                            <td class="p-6 text-xs font-bold text-slate-400">{{ $survey->created_at->format('d/m/Y') }}</td>
                            <td class="p-6 font-cool text-lg">{{ $survey->nama }}</td>
                            @for($i=1; $i<=9; $i++)
                                @php $q = "q$i"; @endphp
                                <td class="p-4 text-center font-black text-sm">{{ $survey->$q }}</td>
                            @endfor
                            <td class="p-6 text-center">
                                <span class="inline-block px-4 py-2 bg-[#ffbe0b] text-[#352700] text-sm font-black sharp">
                                    {{ $survey->rata_rata }}
                                </span>
                            </td>
                            <td class="p-6 text-right">
                                <form action="/admin/surveys/{{ $survey->id }}" method="POST" onsubmit="return confirm('Hapus data survey ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#ff006e] hover:text-[#00183e] p-2 transition-colors">
                                        <i data-lucide="trash-2" class="w-6 h-6"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="p-20 text-center font-lemon text-sm text-slate-400 italic">BELUM ADA DATA SURVEY</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-12">
            {{ $surveys->links() }}
        </div>
    </div>
</x-app-layout>
