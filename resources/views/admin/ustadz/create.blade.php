@extends('layouts.app')
@section('title', 'Tambah Ustadz')
@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-6">Tambah Ustadz Baru</h2>
            <form action="{{ route('admin.ustadz.store') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-slate-300 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('nama') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-slate-300 mb-1">Topik Keahlian</label>
                    <input type="text" name="topik_keahlian" value="{{ old('topik_keahlian') }}"
                        placeholder="contoh: Fiqih, Aqidah"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-slate-300 mb-1">Kontak</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="No. HP / Email"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('admin.ustadz.index') }}"
                        class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-xl">Batal</a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl shadow-lg shadow-emerald-500/20">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection