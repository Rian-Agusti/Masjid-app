@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
    <div class="space-y-6">
        <!-- Header (opsional) -->
        <div>
            <h2 class="text-2xl font-bold text-white">Laporan Keuangan</h2>
            <p class="text-slate-400 text-sm mt-1">Ringkasan pemasukan dan pengeluaran</p>
        </div>

        <!-- Ringkasan Card -->
        @php
            $totalIncome = $transactions->where('type', 'income')->sum('amount');
            $totalExpense = $transactions->where('type', 'expense')->sum('amount');
            $balance = $totalIncome - $totalExpense;
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                <p class="text-slate-400 text-sm uppercase tracking-wide">Total Pemasukan</p>
                <p class="text-3xl font-bold text-emerald-400 mt-3">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                <p class="text-slate-400 text-sm uppercase tracking-wide">Total Pengeluaran</p>
                <p class="text-3xl font-bold text-rose-400 mt-3">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
            </div>
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                <p class="text-slate-400 text-sm uppercase tracking-wide">Saldo Akhir</p>
                <p class="text-3xl font-bold text-white mt-3">Rp {{ number_format($balance, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Jenis</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Nominal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($transaction->type == 'income')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-500/20 text-emerald-400">
                                            <i class="ri-arrow-up-line"></i> Pemasukan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-rose-500/20 text-rose-400">
                                            <i class="ri-arrow-down-line"></i> Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ $transaction->category }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium {{ $transaction->type == 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-slate-300 max-w-xs truncate">{{ $transaction->description ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ri-coins-line text-5xl text-slate-600"></i>
                                        <p class="text-slate-400">Belum ada transaksi keuangan</p>
                                        <p class="text-slate-500 text-sm">Silakan tambahkan transaksi melalui menu Manajemen Keuangan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
