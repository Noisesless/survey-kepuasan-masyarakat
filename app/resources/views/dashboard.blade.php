<x-app-layout>
    <x-slot name="title">Dashboard Admin</x-slot>

    <div class="p-6 lg:p-12 max-w-7xl mx-auto"
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
         ">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
                <p class="text-slate-500">Ringkasan data survey kepuasan masyarakat.</p>
            </div>
            <div class="flex gap-3">
                <a href="/admin/surveys" class="bg-blue-600 text-white px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-blue-700 transition-all">Lihat Semua Data</a>
                <a href="/admin/export" class="bg-emerald-600 text-white px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-emerald-700 transition-all flex items-center gap-2">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-blue-600">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Total Responden</span>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-bold">{{ $stats['total'] }}</span>
                    <i data-lucide="users" class="w-10 h-10 text-slate-200 dark:text-slate-700"></i>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-amber-500">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Rata-rata Skor</span>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-bold">{{ number_format($stats['rata_rata'], 1) }}</span>
                    <div class="flex gap-1 text-amber-500 mb-2">
                        @for($i = 0; $i < round($stats['rata_rata']); $i++)
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-emerald-600">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Status Sistem</span>
                <div class="flex items-end justify-between">
                    <span class="text-2xl font-bold text-emerald-600 uppercase tracking-tighter">Aktif</span>
                    <i data-lucide="check-circle" class="w-10 h-10 text-emerald-100 dark:text-emerald-900/30"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Chart Section -->
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-200 dark:border-slate-700">
                <h2 class="text-xl font-bold mb-8 uppercase tracking-widest">Distribusi Skor</h2>
                <div class="h-64">
                    <canvas id="scoreChart"></canvas>
                </div>
            </div>

            <!-- Recent Surveys Table -->
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-200 dark:border-slate-700">
                <h2 class="text-xl font-bold mb-8 uppercase tracking-widest">Survey Terbaru</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-slate-100 dark:border-slate-800">
                                <th class="pb-4 font-bold uppercase text-[10px] tracking-widest">Nama</th>
                                <th class="pb-4 font-bold uppercase text-[10px] tracking-widest text-center">Skor</th>
                                <th class="pb-4 font-bold uppercase text-[10px] tracking-widest">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($stats['terbaru'] as $survey)
                                <tr>
                                    <td class="py-4 text-sm font-semibold">{{ $survey->nama }}</td>
                                    <td class="py-4 text-center">
                                        <span class="inline-block px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-600 text-xs font-bold sharp">
                                            {{ $survey->skor }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-xs text-slate-500">{{ $survey->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('scoreChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['1', '2', '3', '4', '5'],
                    datasets: [{
                        label: 'Jumlah Responden',
                        data: [0, 0, 1, 1, 1], // Replace with actual data later
                        backgroundColor: '#2563eb',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>
