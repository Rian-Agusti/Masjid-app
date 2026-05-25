@extends('layouts.app')

@section('title', 'Jadwal Petugas Masjid')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-slate-700/50">
        <h2 class="text-2xl font-bold text-white mb-6">Pilih Jadwal yang Mau Dikelola</h2>

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Card Jadwal Jumat --}}
            <div
                class="border border-slate-700 rounded-xl p-6 flex flex-col items-center bg-slate-800/30 hover:bg-slate-700/50 transition">
                <h3 class="text-xl font-semibold text-white mb-6">Jadwal Sholat Jumat</h3>
                <p class="text-slate-400 mb-6 text-center">Kelola jadwal khatib, imam, bilal, muadzin, dan tema khutbah.</p>
                <a href="{{ route('admin.jadwal-jumat.index') }}"
                    class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition">
                    Manage Jadwal Jumat
                </a>
            </div>

            {{-- Card Jadwal Marbot --}}
            <div
                class="border border-slate-700 rounded-xl p-6 flex flex-col items-center bg-slate-800/30 hover:bg-slate-700/50 transition">
                <h3 class="text-xl font-semibold text-white mb-5">Jadwal Marbot / Kebersihan</h3>
                <p class="text-slate-400 mb-5 text-center">Kelola jadwal petugas kebersihan, shift, dan tugas harian.</p>
                <a href="{{ route('admin.jadwal-marbot.index') }}"
                    class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition mb-5">
                    Manage Jadwal Marbot
                </a>
            </div>
        </div>
    </div>
@endsection