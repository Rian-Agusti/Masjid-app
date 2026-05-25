@extends('layouts.app')

@section('title', 'Data Ustadz')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white">Data Ustadz / Pemateri</h2>
                <p class="text-slate-400 text-sm mt-1">Kelola profil ustadz dan topik keahlian</p>
            </div>
            <a href="{{ route('admin.ustadz.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all shadow-lg shadow-emerald-500/20">
                <i class="ri-add-line text-lg"></i>
                <span>Tambah Ustadz</span>
            </a>
        </div>

        <!-- Search -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-4">
            <form method="GET" action="{{ route('admin.ustadz.index') }}" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" placeholder="Cari nama atau keahlian..." value="{{ request('search') }}"
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <button type="submit"
                    class="px-5 py-2.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-xl transition">
                    <i class="ri-search-line"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.ustadz.index') }}"
                        class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-xl transition">
                        <i class="ri-close-line"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Nama</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Topik Keahlian</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Kontak</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($ustadzs as $ustadz)
                            <tr class="hover:bg-slate-800/50">
                                <td class="px-6 py-4 text-white font-medium">{{ $ustadz->nama }}</td>
                                <td class="px-6 py-4 text-slate-300">{{ $ustadz->topik_keahlian ?: '-' }}</td>
                                <td class="px-6 py-4 text-slate-300">{{ $ustadz->kontak ?: '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.ustadz.edit', $ustadz) }}"
                                            class="p-1.5 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg"
                                            title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <form action="{{ route('admin.ustadz.destroy', $ustadz) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus?')">
                                            @csrf @method('DELETE')
                                            <button
                                                class="p-1.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg"
                                                title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada data ustadz</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($ustadzs->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">{{ $ustadzs->links() }}</div>
            @endif
        </div>
    </div>
@endsection