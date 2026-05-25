@extends('layouts.app')

@section('title', 'Dashboard Admin Masjid')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    <div class="space-y-8">
        {{-- Header --}}
        <div class="text-center">
            <h1 class="text-3xl font-bold text-white mb-2">Dashboard Admin Masjid</h1>
            <p class="text-slate-400">Selamat datang, Admin! Berikut ringkasan aktivitas masjid.</p>
        </div>

        {{-- Statistik Cards (5 cards) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            <x-stat-card title="Total Users" :value="$totalUsers ?? 0" subtitle="Aktif bulan ini" color="emerald" />
            <x-stat-card title="Artikel" :value="$totalArticles ?? 0" subtitle="Dipublikasikan" color="indigo" />
            <x-stat-card title="Pengumuman" :value="$totalPengumuman ?? 0" subtitle="Terbaru minggu ini" color="pink" />
            <x-stat-card title="Keuangan" :value="isset($totalKeuangan) ? 'Rp ' . number_format($totalKeuangan, 0, ',', '.') : 'Rp 0'" subtitle="Saldo saat ini" color="yellow" />
            <x-stat-card title="Total Jadwal" :value="$totalJadwal ?? 0" subtitle="Jumat & Marbot" color="purple" />
        </div>

        {{-- Grafik Keuangan Bulanan (Bar Chart) --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6 mt-6 border border-slate-700/50">
            <h3 class="text-xl font-bold text-white mb-4">Grafik Keuangan Bulanan</h3>
            <canvas id="keuanganChart" height="100" class="w-full"></canvas>
        </div>

        {{-- Aktivitas Terbaru dengan Pagination --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6 mt-6 border border-slate-700/50">
            <h3 class="text-xl font-bold text-white mb-4">Aktivitas Terbaru</h3>
            <ul class="space-y-3">
                @forelse($activities as $activity)
                    <li class="flex items-start gap-3 text-slate-300 hover:text-white transition">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></span>
                        <div class="flex-1">
                            <p>{{ $activity->description }}</p>
                            <p class="text-xs text-slate-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </li>
                @empty
                    <li class="text-slate-400">Belum ada aktivitas</li>
                @endforelse
            </ul>
            <div class="mt-4 mb-4">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('keuanganChart');
            if (!canvas) return;

            const labels = @json($chartLabels ?? []);
            const pemasukan = @json($chartDataPemasukan ?? []);
            const pengeluaran = @json($chartDataPengeluaran ?? []);

            if (labels.length === 0 && pemasukan.length === 0 && pengeluaran.length === 0) {
                canvas.style.display = 'none';
                canvas.parentElement.innerHTML += '<p class="text-center text-slate-400">Belum ada data keuangan untuk grafik.</p>';
                return;
            }

            new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Pemasukan (Rp)',
                            data: pemasukan,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: '#10b981',
                            borderWidth: 1,
                            borderRadius: 6
                        },
                        {
                            label: 'Pengeluaran (Rp)',
                            data: pengeluaran,
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderColor: '#ef4444',
                            borderWidth: 1,
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { labels: { color: '#cbd5e1' } },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let value = context.raw;
                                    return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: { color: '#94a3b8' },
                            grid: { color: '#334155' },
                            title: { display: true, text: 'Jumlah (Rp)', color: '#94a3b8' },
                            beginAtZero: true
                        },
                        x: {
                            ticks: { color: '#94a3b8' },
                            grid: { color: '#334155' }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
@endpush