@csrf
<div class="space-y-5">
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Nama Petugas</label>
        <input type="text" name="nama_petugas" value="{{ old('nama_petugas', $jadwal_marbot->nama_petugas ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500"
            required>
        @error('nama_petugas') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Tanggal Piket</label>
        <input type="date" name="tanggal_piket" value="{{ old('tanggal_piket', $jadwal_marbot->tanggal_piket ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-emerald-500"
            required>
        @error('tanggal_piket') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Shift</label>
        <select name="shift"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-emerald-500"
            required>
            <option value="">-- Pilih Shift --</option>
            @foreach(['Pagi', 'Siang', 'Malam'] as $s)
                <option value="{{ $s }}" {{ old('shift', $jadwal_marbot->shift ?? '') == $s ? 'selected' : '' }}>{{ $s }}
                </option>
            @endforeach
        </select>
        @error('shift') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Tugas</label>
        <input type="text" name="tugas" value="{{ old('tugas', $jadwal_marbot->tugas ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500"
            required>
        @error('tugas') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Keterangan</label>
        <textarea name="keterangan" rows="3"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500">{{ old('keterangan', $jadwal_marbot->keterangan ?? '') }}</textarea>
        @error('keterangan') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.jadwal-marbot.index') }}"
            class="px-5 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-lg transition">Batal</a>
        <button type="submit"
            class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition flex items-center gap-2">
            <i class="ri-save-line"></i> Simpan
        </button>
    </div>
</div>