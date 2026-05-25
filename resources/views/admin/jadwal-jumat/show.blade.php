@extends('layouts.app')

@section('title', 'Detail Jadwal Jumat')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Detail Jadwal Jumat</h2>

        <div class="space-y-4 text-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-700/30 rounded-lg">
                <div>
                    <span class="text-slate-400">Tanggal</span>
                    <p class="font-medium">{{ \Carbon\Carbon::parse($jadwal_jumat->tanggal_jumat)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Khatib</span>
                    <p class="font-medium">{{ $jadwal_jumat->khatib }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Imam</span>
                    <p class="font-medium">{{ $jadwal_jumat->imam }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Bilal</span>
                    <p class="font-medium">{{ $jadwal_jumat->bilal ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Muadzin</span>
                    <p class="font-medium">{{ $jadwal_jumat->muadzin ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-slate-400">Tema Khutbah</span>
                    <p class="font-medium">{{ $jadwal_jumat->tema_khutbah ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.jadwal-jumat.index') }}"
                class="px-4 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-lg transition">
                Kembali
            </a>
        </div>
    </div>
@endsection