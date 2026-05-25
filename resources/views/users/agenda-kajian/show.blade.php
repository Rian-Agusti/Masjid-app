@extends('layouts.app')

@section('title', $kajian->judul)

@section('content')
    <div class="space-y-6">
        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('users.agenda-kajian.index') }}"
               class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-400 transition-colors">
                <i class="ri-arrow-left-line"></i> Kembali ke daftar kajian
            </a>
        </div>

        <!-- Card Detail Kajian -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <!-- Header (judul + status) -->
            <div class="border-b border-slate-700 px-6 py-5 md:px-8 bg-slate-800/40">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-white">{{ $kajian->judul }}</h2>
                        <p class="text-slate-400 text-sm mt-1">ID: #{{ $kajian->id }}</p>
                    </div>
                    <div>
                        @php
                            $statusColor = match($kajian->status) {
                                'akan_datang' => 'emerald',
                                'berlangsung' => 'blue',
                                'selesai' => 'slate',
                                default => 'slate'
                            };
                            $statusLabel = match($kajian->status) {
                                'akan_datang' => 'Akan Datang',
                                'berlangsung' => 'Berlangsung',
                                'selesai' => 'Selesai',
                                default => $kajian->status
                            };
                        @endphp
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-sm font-medium bg-{{ $statusColor }}-500/20 text-{{ $statusColor }}-400">
                            <i class="ri-calendar-check-line"></i> {{ $statusLabel }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Body Informasi -->
            <div class="p-6 md:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Tanggal -->
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Tanggal</p>
                        <p class="text-white font-medium text-lg mt-1">
                            {{ \Carbon\Carbon::parse($kajian->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                        </p>
                    </div>
                    <!-- Waktu -->
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Waktu</p>
                        <p class="text-white font-medium text-lg mt-1">
                            {{ \Carbon\Carbon::parse($kajian->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kajian->waktu_selesai)->format('H:i') }} WIB
                        </p>
                    </div>
                    <!-- Lokasi -->
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Lokasi</p>
                        <p class="text-white font-medium text-lg mt-1">
                            <i class="ri-map-pin-line text-emerald-400 mr-1"></i> {{ $kajian->lokasi }}
                        </p>
                    </div>
                    <!-- Ustadz -->
                    <div>
                        <p class="text-slate-400 text-sm uppercase tracking-wide">Penceramah</p>
                        <p class="text-white font-medium text-lg mt-1">
                            <i class="ri-user-star-line text-emerald-400 mr-1"></i> {{ $kajian->ustadz?->nama ?? 'Belum ditentukan' }}
                        </p>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <p class="text-slate-400 text-sm uppercase tracking-wide mb-2">Deskripsi Kajian</p>
                    <div class="bg-slate-900/50 rounded-xl p-5 border border-slate-700 text-slate-300 leading-relaxed">
                        {{ $kajian->deskripsi ?: '<em class="text-slate-500">Tidak ada deskripsi untuk kajian ini.</em>' }}
                    </div>
                </div>
            </div>

            <!-- Footer (opsional) -->
            <div class="border-t border-slate-700 px-6 py-4 md:px-8 bg-slate-800/40 text-center text-sm text-slate-500">
                <i class="ri-mosque-line"></i> Semoga bermanfaat, hadiri kajian tepat waktu.
            </div>
        </div>
    </div>
@endsection
