@extends('layouts.app')

@section('title', 'Detail Transaksi Keuangan')

@section('content')
    <div class="space-y-6">
        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('admin.keuangan.index') }}"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar
            </a>
        </div>

        <!-- Card Detail Nota -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <!-- Header Nota -->
            <div class="border-b border-slate-700 px-6 py-5 md:px-8 bg-slate-800/40">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h2 class="text-xl font-semibold text-white">Detail Transaksi</h2>
                        <p class="text-slate-400 text-sm mt-0.5">ID: #{{ $keuangan->id }}</p>
                    </div>
                    <div>
                        @if($keuangan->type == 'income')
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium bg-emerald-500/20 text-emerald-400">
                                <i class="ri-arrow-up-line"></i> PEMASUKAN
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium bg-rose-500/20 text-rose-400">
                                <i class="ri-arrow-down-line"></i> PENGELUARAN
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Body Nota -->
            <div class="p-6 md:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Tanggal Transaksi</p>
                        <p class="text-white text-lg font-medium mt-1">
                            {{ \Carbon\Carbon::parse($keuangan->date)->isoFormat('D MMMM YYYY') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Kategori</p>
                        <p class="text-white text-lg font-medium mt-1">{{ $keuangan->category ?: '-' }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Nominal</p>
                        <p
                            class="text-3xl font-bold {{ $keuangan->type == 'income' ? 'text-emerald-400' : 'text-rose-400' }} mt-1">
                            Rp {{ number_format($keuangan->amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Dibuat oleh</p>
                        <p class="text-white text-lg font-medium mt-1">{{ $keuangan->user->name }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-slate-400 text-sm uppercase tracking-wide">Deskripsi</p>
                    <div class="mt-2 p-4 bg-slate-900/50 rounded-xl border border-slate-700 text-slate-300">
                        {{ $keuangan->description ?: '<em class="text-slate-500">Tidak ada deskripsi</em>' }}
                    </div>
                </div>
            </div>

            <!-- Footer Aksi -->
            <div class="border-t border-slate-700 px-6 py-5 md:px-8 bg-slate-800/40 flex flex-wrap gap-3">
                <a href="{{ route('admin.keuangan.edit', $keuangan) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg transition-all duration-200">
                    <i class="ri-edit-line"></i> Edit Transaksi
                </a>
                <form action="{{ route('admin.keuangan.destroy', $keuangan) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus transaksi ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg transition-all duration-200">
                        <i class="ri-delete-bin-line"></i> Hapus Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
