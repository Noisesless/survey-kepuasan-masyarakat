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
                <p class="text-slate-500">Ringkasan data survey kepuasan masyarakat (SKM).</p>
            </div>
            <div class="flex gap-3">
                <a href="/admin/surveys" class="bg-slate-900 text-white px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-slate-800 transition-all">Lihat Semua Data</a>
                <a href="/admin/export" class="bg-lime-500 text-slate-950 px-6 py-3 font-bold uppercase tracking-wider sharp soft-shadow hover:bg-lime-400 transition-all flex items-center gap-2">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-indigo-900">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Total Responden</span>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-bold">{{ $stats['total'] }}</span>
                    <i data-lucide="users" class="w-10 h-10 text-slate-100 dark:text-slate-800"></i>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-lime-400">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Indeks Kepuasan (IKM)</span>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-bold">{{ number_format($stats['rata_rata'], 2) }}</span>
                    <div class="flex gap-1 text-lime-500 mb-2">
                        @for($i = 0; $i < round($stats['rata_rata']); $i++)
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border-l-4 border-slate-900">
                <span class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-4">Mutu Layanan</span>
                <div class="flex items-end justify-between">
                    @php
                        $mutu = 'D'; $label = 'Tidak Baik';
                        if($stats['rata_rata'] >= 4) { $mutu = 'A'; $label = 'Sangat Baik'; }
                        elseif($stats['rata_rata'] >= 3) { $mutu = 'B'; $label = 'Baik'; }
                        elseif($stats['rata_rata'] >= 2) { $mutu = 'C'; $label = 'Kurang Baik'; }
                    @endphp
                    <span class="text-2xl font-bold text-slate-900 dark:text-white uppercase tracking-tighter">{{ $mutu }} ({{ $label }})</span>
                    <i data-lucide="award" class="w-10 h-10 text-slate-100 dark:text-slate-800"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Chart Section -->
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-100 dark:border-slate-800">
                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-8">Analisis per Indikator</h2>
                <div class="h-80">
                    <canvas id="indicatorChart"></canvas>
                </div>
            </div>

            <!-- Recent Surveys Table -->
            <div class="bg-white dark:bg-slate-900 p-8 sharp soft-shadow border border-slate-100 dark:border-slate-800">
                <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 mb-8">Komentar Terbaru</h2>
                <div class="space-y-6">
                    @foreach($stats['terbaru'] as $survey)
                        <div class="border-b border-slate-50 dark:border-slate-800 pb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold text-sm">{{ $survey->nama }}</span>
                                <span class="text-[10px] font-black px-2 py-1 bg-lime-400 text-slate-950 sharp">{{ $survey->rata_rata }}</span>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed italic">"{{ $survey->komentar }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('indicatorChart').getContext('2d');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9'],
                    datasets: [{
                        label: 'Nilai Indikator',
                        data: [
                            {{ $stats['indikator']['q1'] }},
                            {{ $stats['indikator']['q2'] }},
                            {{ $stats['indikator']['q3'] }},
                            {{ $stats['indikator']['q4'] }},
                            {{ $stats['indikator']['q5'] }},
                            {{ $stats['indikator']['q6'] }},
                            {{ $stats['indikator']['q7'] }},
                            {{ $stats['indikator']['q8'] }},
                            {{ $stats['indikator']['q9'] }}
                        ],
                        backgroundColor: 'rgba(217, 249, 157, 0.2)',
                        borderColor: '#d9f99d',
                        pointBackgroundColor: '#1e1b4b',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 5,
                            ticks: { display: false }
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
