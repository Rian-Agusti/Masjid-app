@extends('layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')
    <div class="space-y-6">
        <!-- Header + Tombol -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white mx-auto sm:mx-0">Daftar Artikel</h2>
                <p class="text-slate-400 text-sm mt-1">Kelola semua artikel yang telah dipublikasikan</p>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="h-1 w-24 bg-gradient-to-r from-transparent via-emerald-500/50 to-transparent rounded-full">
                </div>
            </div>

            <a href="{{ route('admin.articles.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20">
                <i class="ri-add-line text-lg"></i>
                <span>Tambah Artikel</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div
                class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-5 py-3 rounded-xl flex items-center gap-2">
                <i class="ri-checkbox-circle-line text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Card Table -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Penulis</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($articles as $article)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-white">{{ $article->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ $article->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300">
                                    {{ $article->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.articles.show', $article) }}"
                                            class="px-3 py-1.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                            <i class="ri-eye-line"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                            class="px-3 py-1.5 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                            <i class="ri-edit-line"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus artikel ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200 inline-flex items-center gap-1">
                                                <i class="ri-delete-bin-line"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <i class="ri-article-line text-5xl text-slate-600"></i>
                                        <p class="text-slate-400">Belum ada artikel.</p>
                                        <p class="text-slate-500 text-sm">Silakan tambahkan artikel pertama 🚀</p>
                                        <a href="{{ route('admin.articles.create') }}"
                                            class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/20 hover:bg-emerald-500 text-emerald-400 hover:text-white rounded-lg transition">
                                            <i class="ri-add-line"></i> Buat artikel
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($articles->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
