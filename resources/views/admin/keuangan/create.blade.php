@extends('layouts.app')

@section('title', 'Tambah Transaksi Keuangan')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Tambah Transaksi</h2>
            <p class="text-slate-400 text-sm mt-1">Catat pemasukan atau pengeluaran baru</p>
        </div>

        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl p-6 md:p-8">
            <form action="{{ route('admin.keuangan.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.keuangan.form')
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.keuangan.index') }}"
                        class="px-5 py-2.5 border border-slate-600 rounded-xl text-slate-300 hover:bg-slate-700 hover:text-white transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                        <i class="ri-save-line"></i>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
