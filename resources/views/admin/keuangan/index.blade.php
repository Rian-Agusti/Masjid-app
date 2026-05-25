@extends('layouts.app')

@section('title', 'Manajemen Keuangan')

@section('content')
        <div class="space-y-6">
            <!-- Export PDF dan EXCELL   -->
            <div class="mb-4">
                <a href="{{ route('admin.keuangan.export-pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded">
                    Export PDF
                </a>
            </div>

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">Keuangan Masjid</h2>
                    <p class="text-slate-400 text-sm mt-1">Kelola pemasukan dan pengeluaran</p>
                </div>
                <a href="{{ route('admin.keuangan.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20">
                    <i class="ri-add-line text-lg"></i>
                    <span>Tambah Transaksi</span>
                </a>
            </div>

            <!-- Ringkasan Saldo (Card) - Diperbaiki jarak dan tanpa ikon -->
            @php
    $totalIncome = $transactions->where('type', 'income')->sum('amount');
    $totalExpense = $transactions->where('type', 'expense')->sum('amount');
    $balance = $totalIncome - $totalExpense;
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Pemasukan -->
                <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Total Pemasukan</p>
                        <p class="text-3xl font-bold text-emerald-400 mt-3">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Total Pengeluaran</p>
                        <p class="text-3xl font-bold text-rose-400 mt-3">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Saldo Akhir -->
                <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6 shadow-lg">
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Saldo Akhir</p>
                        <p class="text-3xl font-bold text-white mt-3">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Form Pencarian -->
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-4">
                <form method="GET" action="{{ route('admin.keuangan.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Cari kategori atau deskripsi..." value="{{ request('search') }}"
                               class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-xl transition-all duration-200 inline-flex items-center gap-2">
                        <i class="ri-search-line"></i> Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.keuangan.index') }}" class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 hover:text-white rounded-xl transition-all duration-200 inline-flex items-center gap-2">
                            <i class="ri-close-line"></i> Reset
                        </a>
                    @endif
                </form>
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
                                <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi</th>
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.keuangan.show', $transaction) }}"
                                               class="p-1.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-lg transition-all duration-200" title="Lihat">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('admin.keuangan.edit', $transaction) }}"
                                               class="p-1.5 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg transition-all duration-200" title="Edit">
                                                <i class="ri-edit-line"></i>
                                            </a>
                                            <form action="{{ route('admin.keuangan.destroy', $transaction) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg transition-all duration-200" title="Hapus">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <p class="text-slate-400">Belum ada transaksi keuangan</p>
                                            <p class="text-slate-500 text-sm">Silakan tambahkan transaksi pertama</p>
                                            <a href="{{ route('admin.keuangan.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-lg transition">
                                                <i class="ri-add-line"></i> Tambah transaksi
                                            </a>
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
