@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="space-y-6">
        <!-- Breadcrumb / Back Link -->
        <div class="flex items-center gap-2 text-sm text-black">
            <a href="{{ route('admin.articles.index') }}" class="hover:text-emerald-400 transition flex items-center gap-1">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar
            </a>
            <i class="ri-arrow-right-s-line text-xs"></i>
            <span class="text-slate-300">{{ Str::limit($article->title, 40) }}</span>
        </div>

        <!-- Main Article Card -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <!-- Header: Judul & Meta -->
            <div class="border-b border-slate-700 px-6 py-5 md:px-8 md:py-6">
                <h1 class="text-2xl md:text-3xl font-bold text-white leading-tight">{{ $article->title }}</h1>
                <div class="flex flex-wrap items-center gap-3 mt-3 text-sm text-black">
                    <div class="flex items-center gap-1">
                        <i class="ri-user-line"></i>
                        <span>{{ $article->user->name }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <i class="ri-calendar-line"></i>
                        <span>{{ $article->created_at->isoFormat('D MMMM YYYY') }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <i class="ri-time-line"></i>
                        <span>{{ $article->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <!-- Content Body -->
            <div class="px-6 py-6 md:px-8 md:py-8 prose prose-invert max-w-none">
                {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Footer Actions -->
            <div
                class="border-t border-slate-700 px-6 py-5 md:px-8 bg-slate-800/40 flex flex-wrap gap-3 justify-between items-center">
                <div class="flex gap-3">
                    <a href="{{ route('admin.articles.edit', $article) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg transition-all duration-200">
                        <i class="ri-edit-line"></i> Edit Artikel
                    </a>
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg transition-all duration-200">
                            <i class="ri-delete-bin-line"></i> Hapus
                        </button>
                    </form>
                </div>
                <a href="{{ route('admin.articles.index') }}"
                    class="text-sm text-black hover:text-slate-200 transition flex items-center gap-1">
                    <i class="ri-arrow-left-line"></i> Kembali ke daftar
                </a>
            </div>
        </div>
    </div>
@endsection