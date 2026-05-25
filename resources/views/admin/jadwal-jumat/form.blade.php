@csrf
<div class="space-y-5">
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Tanggal Jumat</label>
        <input type="date" name="tanggal_jumat" value="{{ old('tanggal_jumat', $jadwal_jumat->tanggal_jumat ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500"
            required>
        @error('tanggal_jumat') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Khatib</label>
        <input type="text" name="khatib" value="{{ old('khatib', $jadwal_jumat->khatib ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500"
            required>
        @error('khatib') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Imam</label>
        <input type="text" name="imam" value="{{ old('imam', $jadwal_jumat->imam ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500"
            required>
        @error('imam') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Bilal</label>
        <input type="text" name="bilal" value="{{ old('bilal', $jadwal_jumat->bilal ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500">
        @error('bilal') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Muadzin</label>
        <input type="text" name="muadzin" value="{{ old('muadzin', $jadwal_jumat->muadzin ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500">
        @error('muadzin') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-300 mb-1">Tema Khutbah</label>
        <input type="text" name="tema_khutbah" value="{{ old('tema_khutbah', $jadwal_jumat->tema_khutbah ?? '') }}"
            class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500">
        @error('tema_khutbah') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.jadwal-jumat.index') }}"
            class="px-5 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-lg transition">Batal</a>
        <button type="submit" class="px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition">
            Simpan
        </button>
    </div>
</div>