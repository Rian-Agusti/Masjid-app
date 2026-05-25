@extends('layouts.app')

@section('title', 'Edit Aset')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-6">Edit Aset</h2>

            <form action="{{ route('admin.asets.update', $aset) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-slate-300 mb-1">Nama Aset</label>
                    <input type="text" name="nama" value="{{ old('nama', $aset->nama) }}" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('nama') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-300 mb-1">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $aset->kategori) }}"
                        placeholder="contoh: Elektronik, Furnitur"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    @error('kategori') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-300 mb-1">Status</label>
                    <select name="status" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Baik" {{ old('status', $aset->status) == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Perlu Perbaikan" {{ old('status', $aset->status) == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                        <option value="Rusak" {{ old('status', $aset->status) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('deskripsi', $aset->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <a href="{{ route('admin.asets.index') }}"
                        class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-xl transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition shadow-lg shadow-emerald-500/20">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
