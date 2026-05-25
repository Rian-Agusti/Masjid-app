@extends('layouts.app')

@section('title', $pengumuman->title)

@section('content')
    <div class="space-y-6">
        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('admin.pengumuman-masjid.index') }}"
                class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar
            </a>
        </div>

        <!-- Card Detail -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            @if($pengumuman->thumbnail)
                <div class="h-56 md:h-72 overflow-hidden">
                    <img src="{{ asset('storage/' . $pengumuman->thumbnail) }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="h-48 md:h-64 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 flex items-center justify-center">
                    <i class="ri-megaphone-line text-7xl text-emerald-400/60"></i>
                </div>
            @endif

            <div class="p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $pengumuman->title }}</h1>

                <div
                    class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-4 text-sm text-slate-400 border-b border-slate-700 pb-5">
                    <div class="flex items-center gap-1"><i class="ri-user-line"></i> {{ $pengumuman->user->name }}</div>
                    <div class="flex items-center gap-1"><i class="ri-calendar-line"></i>
                        {{ $pengumuman->created_at->isoFormat('D MMMM YYYY') }}</div>
                    <div class="flex items-center gap-1"><i class="ri-time-line"></i>
                        {{ $pengumuman->created_at->diffForHumans() }}</div>
                    <div>
                        @if($pengumuman->is_published)
                            <span
                                class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-medium bg-emerald-500/20 text-emerald-400">
                                <i class="ri-checkbox-circle-line"></i> Published
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-medium bg-slate-700 text-slate-300">
                                <i class="ri-draft-line"></i> Draft
                            </span>
                        @endif
                    </div>
                </div>

                <div class="prose prose-invert max-w-none mt-6">
                    {!! nl2br(e($pengumuman->content)) !!}
                </div>

                <div class="mt-8 flex flex-wrap gap-3 pt-5 border-t border-slate-700">
                    <a href="{{ route('admin.pengumuman-masjid.edit', $pengumuman) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg transition-all duration-200">
                        <i class="ri-edit-line"></i> Edit
                    </a>
                    <form action="{{ route('admin.pengumuman-masjid.destroy', $pengumuman) }}" method="POST"
                        onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg transition-all duration-200">
                            <i class="ri-delete-bin-line"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection