@extends('layouts.app')

@section('title', 'Detail Aset')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Detail Aset</h2>
                <a href="{{ route('admin.asets.index') }}"
                    class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm transition">
                    <i class="ri-arrow-left-line mr-1"></i> Kembali
                </a>
            </div>

            <div class="space-y-4">
                <!-- Nama Aset -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Nama Aset</span>
                    <p class="text-white text-lg font-semibold">{{ $aset->nama }}</p>
                </div>

                <!-- Kategori -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Kategori</span>
                    <p class="text-white">{{ $aset->kategori ?: '-' }}</p>
                </div>

                <!-- Status -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Status</span>
                    <p>
                        @if($aset->status == 'Baik')
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-medium bg-emerald-500/20 text-emerald-400">
                                <i class="ri-check-line"></i> Baik
                            </span>
                        @elseif($aset->status == 'Perlu Perbaikan')
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-medium bg-yellow-500/20 text-yellow-400">
                                <i class="ri-tools-line"></i> Perlu Perbaikan
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-medium bg-red-500/20 text-red-400">
                                <i class="ri-close-circle-line"></i> Rusak
                            </span>
                        @endif
                    </p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Deskripsi</span>
                    <p class="text-slate-300 leading-relaxed">{{ $aset->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                </div>

                <!-- Tanggal Dibuat -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Terdaftar Sejak</span>
                    <p class="text-slate-300">{{ $aset->created_at->format('d M Y, H:i') }}</p>
                </div>

                <!-- Tanggal Diperbarui -->
                <div>
                    <span class="text-slate-400 text-sm uppercase tracking-wide">Terakhir Diperbarui</span>
                    <p class="text-slate-300">{{ $aset->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-700">
                <a href="{{ route('admin.asets.edit', $aset) }}"
                    class="px-5 py-2.5 bg-yellow-500/20 hover:bg-yellow-500 text-yellow-300 hover:text-white rounded-lg transition inline-flex items-center gap-2">
                    <i class="ri-edit-line"></i> Edit
                </a>
                <form action="{{ route('admin.asets.destroy', $aset) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus aset ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg transition inline-flex items-center gap-2">
                        <i class="ri-delete-bin-line"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
