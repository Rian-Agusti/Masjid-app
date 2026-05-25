@extends('layouts.app')
@section('title', 'Tambah Kajian')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-6">Tambah Agenda Kajian</h2>
            <form action="{{ route('admin.agenda-kajian.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-slate-300 mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-300 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                            placeholder="Ruang Utama, Aula Lantai 2" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-1">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-slate-300 mb-1">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
                <div>
                    <label class="block text-slate-300 mb-1">Pemateri / Ustadz</label>
                    <select name="ustadz_id"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="">-- Pilih Ustadz --</option>
                        @foreach($ustadzs as $ustadz)
                            <option value="{{ $ustadz->id }}" {{ old('ustadz_id') == $ustadz->id ? 'selected' : '' }}>
                                {{ $ustadz->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-300 mb-1">Status</label>
                    <select name="status" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        @foreach(['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $status)
                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('admin.agenda-kajian.index') }}"
                        class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-xl">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl shadow-lg shadow-emerald-500/20">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection