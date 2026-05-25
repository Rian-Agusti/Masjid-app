@extends('layouts.app')

@section('title', 'Manajemen Pengumuman')

@section('content')
    <div class="space-y-6">
        <!-- Header + Tombol Tambah -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white">Pengumuman Masjid</h2>
                <p class="text-slate-400 text-sm mt-1">Kelola daftar pengumuman untuk jamaah</p>
            </div>
            <a href="{{ route('admin.pengumuman-masjid.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20">
                <i class="ri-add-line text-lg"></i>
                <span>Tambah Pengumuman</span>
            </a>
        </div>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-3 rounded-xl flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Card Tabel -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Thumbnail</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Penulis</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($pengumuman as $item)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                        <div class="w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center">
                                            <i class="ri-image-line text-slate-500"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-white">{{ $item->title }}</td>
                                <td class="px-6 py-4 text-slate-300">{{ $item->user->name }}</td>
                                <td class="px-6 py-4">
                                    @if($item->is_published)
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-medium bg-emerald-500/20 text-emerald-400">
                                            <i class="ri-checkbox-circle-line text-sm"></i> Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-medium bg-slate-700 text-slate-300">
                                            <i class="ri-draft-line text-sm"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.pengumuman-masjid.show', $item) }}"
                                           class="px-3 py-1.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                            <i class="ri-eye-line"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.pengumuman-masjid.edit', $item) }}"
                                           class="px-3 py-1.5 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.pengumuman-masjid.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ri-megaphone-line text-5xl text-slate-600"></i>
                                        <p class="text-slate-400">Belum ada pengumuman.</p>
                                        <p class="text-slate-500 text-sm">Silakan tambahkan pengumuman pertama 🚀</p>
                                        <a href="{{ route('admin.pengumuman-masjid.create') }}" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-lg transition">
                                            <i class="ri-add-line"></i> Buat pengumuman
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pengumuman->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">
                    {{ $pengumuman->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
