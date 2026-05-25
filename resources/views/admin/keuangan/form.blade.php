<div class="space-y-6">
    <!-- Jenis Transaksi -->
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-2">Jenis Transaksi</label>
        <div class="flex gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="type" value="income" {{ old('type', $keuangan->type ?? '') == 'income' ? 'checked' : '' }}
                       class="w-4 h-4 text-emerald-500 focus:ring-emerald-500 bg-slate-700 border-slate-600">
                <span class="text-slate-300">Pemasukan</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="radio" name="type" value="expense" {{ old('type', $keuangan->type ?? '') == 'expense' ? 'checked' : '' }}
                       class="w-4 h-4 text-rose-500 focus:ring-rose-500 bg-slate-700 border-slate-600">
                <span class="text-slate-300">Pengeluaran</span>
            </label>
        </div>
        @error('type') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Kategori -->
    <div>
        <label for="category" class="block text-sm font-medium text-slate-300 mb-2">Kategori</label>
        <input type="text" name="category" id="category" value="{{ old('category', $keuangan->category ?? '') }}"
               class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
               placeholder="Misal: Infak, Listrik, Konsumsi">
        @error('category') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Nominal dengan prefix Rp -->
    <div>
        <label for="amount" class="block text-sm font-medium text-slate-300 mb-2">Nominal (Rp)</label>
        <div class="relative">
            <div class="inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <h5 class="text-slate-400">Rp</h5>
            </div>
            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $keuangan->amount ?? '') }}"
                   class="w-full bg-slate-900 border border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                   placeholder="0">
        </div>
        @error('amount') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Tanggal -->
    <div>
        <label for="date" class="block text-sm font-medium text-slate-300 mb-2">Tanggal</label>
        <input type="date" name="date" id="date" value="{{ old('date', $keuangan->date ?? now()->toDateString()) }}"
               class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
        @error('date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Deskripsi -->
    <div>
        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                  placeholder="Detail transaksi...">{{ old('description', $keuangan->description ?? '') }}</textarea>
        @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
</div>
