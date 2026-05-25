@extends('layouts.app')

@section('title', 'Detail Jadwal Marbot')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Detail Jadwal Marbot</h2>

        <div class="space-y-4 text-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-slate-700/30 rounded-lg">
                <div>
                    <span class="text-slate-400">Nama Petugas</span>
                    <p class="font-medium">{{ $jadwal_marbot->nama_petugas }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Tanggal Piket</span>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($jadwal_marbot->tanggal_piket)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Shift</span>
                    <p class="font-medium">{{ $jadwal_marbot->shift }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Tugas</span>
                    <p class="font-medium">{{ $jadwal_marbot->tugas }}</p>
                </div>
                <div class="md:col-span-3">
                    <span class="text-slate-400">Keterangan</span>
                    <p class="font-medium">{{ $jadwal_marbot->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.jadwal-marbot.index') }}"
                class="px-4 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-lg transition inline-flex items-center gap-2">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>
        </div>
    </div>
@endsection