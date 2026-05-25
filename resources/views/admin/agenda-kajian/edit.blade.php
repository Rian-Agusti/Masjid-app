@extends('layouts.app')

@section('title', 'Edit Agenda Kajian')

@section('content')
        <div class="max-w-2xl mx-auto">
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
                <h2 class="text-xl font-bold text-white mb-6">Edit Agenda Kajian</h2>

                {{-- Action diarahkan ke route update --}}
                <form action="{{ route('admin.agenda-kajian.update', $kajian) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-slate-300 mb-1">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $kajian->judul) }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                        @error('judul') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $kajian->tanggal->format('Y-m-d')) }}"
                            required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                        @error('tanggal') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai"
                            value="{{ old('waktu_mulai', $kajian->waktu_mulai->format('H:i')) }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                        @error('waktu_mulai') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai"
                            value="{{ old('waktu_selesai', $kajian->waktu_selesai->format('H:i')) }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                        @error('waktu_selesai') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $kajian->lokasi) }}" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                        @error('lokasi') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Ustadz / Pemateri</label>
                        <select name="ustadz_id"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Ustadz (opsional) --</option>
                            @foreach($ustadzs as $ustadz)
                                <option value="{{ $ustadz->id }}" {{ old('ustadz_id', $kajian->ustadz_id) == $ustadz->id ? 'selected' : '' }}>
                                    {{ $ustadz->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('ustadz_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Status</label>
                        <select name="status" required
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">
                            @foreach(['Terjadwal', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $status)
                                <option value="{{ $status }}" {{ old('status', $kajian->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-300 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-emerald-500">{{ old('deskripsi', $kajian->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('admin.agenda-kajian.index') }}"
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
