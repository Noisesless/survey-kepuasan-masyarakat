<x-app-layout>
    <x-slot name="title">Dashboard Admin</x-slot>

    <div class="p-8 lg:p-20 max-w-7xl mx-auto"
         x-init="
            @if(session('success')) 
                $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }); 
            @endif
         ">
        
        <header class="mb-20">
            <h1 class="font-cool text-8xl tracking-tighter text-[#00183e] mb-4">ADMIN DASHBOARD.</h1>
            <p class="font-lemon text-sm text-slate-400 tracking-[0.3em] uppercase">Monitor Kinerja Layanan Publik</p>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white p-10 border-4 border-[#00183e] shadow-[12px_12px_0px_#00183e] sharp">
                <p class="font-lemon text-[10px] uppercase tracking-widest text-slate-400 mb-6">Total Responden</p>
                <div class="font-cool text-7xl text-[#00183e]">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-[#3a86ff] p-10 border-4 border-[#00183e] shadow-[12px_12px_0px_#00183e] sharp">
                <p class="font-lemon text-[10px] uppercase tracking-widest text-white/70 mb-6">Indeks Kepuasan (IKM)</p>
                <div class="font-cool text-7xl text-white">{{ number_format($stats['rata_rata'], 2) }}</div>
            </div>
            <div class="bg-[#ffbe0b] p-10 border-4 border-[#00183e] shadow-[12px_12px_0px_#00183e] sharp">
                <p class="font-lemon text-[10px] uppercase tracking-widest text-[#352700] mb-6">Mutu Layanan</p>
                @php
                    $mutu = 'D'; $label = 'Tidak Baik';
                    if($stats['rata_rata'] >= 4) { $mutu = 'A'; $label = 'Sangat Baik'; }
                    elseif($stats['rata_rata'] >= 3) { $mutu = 'B'; $label = 'Baik'; }
                    elseif($stats['rata_rata'] >= 2) { $mutu = 'C'; $label = 'Kurang Baik'; }
                @endphp
                <div class="font-cool text-5xl text-[#352700]">{{ $mutu }} <span class="text-2xl font-lemon">{{ $label }}</span></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Analytics (Span 2) -->
            <div class="lg:col-span-2 bg-white p-12 border-4 border-[#00183e] shadow-[15px_15px_0px_#8338ec] sharp">
                <h2 class="font-cool text-4xl mb-12">Analisis Indikator</h2>
                <div class="h-96">
                    <canvas id="indicatorChart"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex flex-col gap-6">
                <a href="/admin/surveys" class="group flex-center bg-[#00183e] text-white p-8 border-4 border-[#00183e] shadow-[8px_8px_0px_#8338ec] sharp hover:bg-[#ff006e] transition-all">
                    <span class="font-lemon text-sm tracking-widest">LIHAT SEMUA DATA</span>
                </a>
                <a href="/admin/export" class="group flex-center bg-white text-[#00183e] p-8 border-4 border-[#00183e] shadow-[8px_8px_0px_#ffbe0b] sharp hover:bg-[#ffbe0b] transition-all">
                    <span class="font-lemon text-sm tracking-widest">EXPORT DATA (CSV)</span>
                </a>
                <a href="/admin/users" class="group flex-center bg-white text-[#00183e] p-8 border-4 border-[#00183e] shadow-[8px_8px_0px_#fb5607] sharp hover:bg-[#fb5607] hover:text-white transition-all">
                    <span class="font-lemon text-sm tracking-widest">MANAJEMEN USER</span>
                </a>
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
                        label: 'Skor Indikator',
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
                        backgroundColor: 'rgba(131, 56, 236, 0.2)',
                        borderColor: '#8338ec',
                        pointBackgroundColor: '#ff006e',
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 5,
                            grid: { color: '#00183e20' },
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
