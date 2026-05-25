@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Edit Pengumuman</h2>
            <p class="text-slate-400 text-sm mt-1">Perbarui informasi pengumuman</p>
        </div>

        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl p-6 md:p-8">
            <form action="{{ route('admin.pengumuman-masjid.update', $pengumuman) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.pengumuman-masjid.form')

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.pengumuman-masjid.index') }}"
                        class="px-5 py-2.5 border border-slate-600 rounded-xl text-slate-300 hover:bg-slate-700 hover:text-white transition-all duration-200">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-200 shadow-lg shadow-emerald-500/20 flex items-center gap-2">
                        <i class="ri-save-line"></i>
                        Update Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection