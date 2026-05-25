<div class="space-y-6">
    <!-- Judul -->
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
        <input type="text" name="title" value="{{ old('title', $pengumuman->title ?? '') }}" required
            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
        @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Thumbnail -->
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-2">Thumbnail</label>
        <input type="file" name="thumbnail" accept="image/*"
            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30 transition">
        @if(isset($pengumuman) && $pengumuman->thumbnail)
            <div class="mt-3">
                <p class="text-xs text-slate-400 mb-1">Thumbnail saat ini:</p>
                <img src="{{ asset('storage/' . $pengumuman->thumbnail) }}"
                    class="w-24 h-24 object-cover rounded-lg border border-slate-600">
            </div>
        @endif
        @error('thumbnail') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Konten -->
    <div>
        <label class="block text-sm font-medium text-slate-300 mb-2">Konten</label>
        <textarea name="content" rows="8" required
            class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">{{ old('content', $pengumuman->content ?? '') }}</textarea>
        @error('content') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <!-- Publish Checkbox -->
    <div>
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_published" value="1" {{ (old('is_published', $pengumuman->is_published ?? true)) ? 'checked' : '' }}
                class="w-4 h-4 rounded border-slate-600 bg-slate-700 text-emerald-500 focus:ring-emerald-500 focus:ring-offset-0">
            <span class="text-sm text-slate-300">Publikasikan sekarang</span>
        </label>
    </div>
</div>