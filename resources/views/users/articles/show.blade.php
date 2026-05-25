@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="space-y-6">
        <!-- Back Button -->
        <div>
            <a href="{{ route('users.articles') }}"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar artikel
            </a>
        </div>

        <!-- Article Card -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-lg overflow-hidden">
            <!-- Hero Thumbnail -->
            <div class="h-48 md:h-64 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 flex items-center justify-center">
                <i class="ri-quill-pen-line text-7xl text-emerald-400/60"></i>
            </div>

            <div class="p-6 md:p-8">
                <!-- Title -->
                <h1 class="text-2xl md:text-3xl font-bold text-white leading-tight">{{ $article->title }}</h1>

                <!-- Meta Info -->
                <div
                    class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-4 text-sm text-slate-400 border-b border-slate-700 pb-5">
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

                <!-- Content -->
                <div class="prose prose-invert max-w-none mt-6">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <!-- Footer -->
                <div class="mt-8 pt-5 border-t border-slate-700 text-center text-sm text-slate-500">
                    <i class="ri-heart-line"></i> Terima kasih telah membaca. Semoga bermanfaat.
                </div>
            </div>
        </div>

        <!-- Bottom Back Link -->
        <div class="text-center">
            <a href="{{ route('users.articles') }}"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors text-sm">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar artikel
            </a>
        </div>
    </div>
@endsection