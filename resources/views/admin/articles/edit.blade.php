@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h2 class="text-2xl font-bold text-white">Edit Artikel</h2>
            <p class="text-slate-400 text-sm mt-1">Perbarui konten artikel</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-xl flex items-start gap-3">
                <i class="ri-alert-line text-xl"></i>
                <div>
                    <strong class="block mb-1">Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl p-6 md:p-8">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-300 mb-2">Judul Artikel</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div>
                    <label for="content" class="block text-sm font-medium text-slate-300 mb-2">Konten</label>
                    <textarea name="content" id="content" rows="10"
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Aksi -->
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.articles.index') }}"
                        class="px-5 py-2.5 border border-slate-600 rounded-xl text-slate-300 hover:bg-slate-700 hover:text-white transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                        <i class="ri-save-line"></i>
                        Update Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
