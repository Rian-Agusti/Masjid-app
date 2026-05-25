@extends('layouts.app')

@section('title', 'Agenda Kajian')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h2 class="text-2xl font-bold text-white">Agenda Kajian</h2>
            <p class="text-slate-400 text-sm mt-1">Jadwal kajian rutin dan pengajian di masjid</p>
        </div>

        <!-- Card Tabel -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Judul Kajian</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Ustadz</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($kajians as $kajian)
                            <tr class="hover:bg-slate-800/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-slate-300">
                                    {{ \Carbon\Carbon::parse($kajian->tanggal)->isoFormat('D MMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-white">{{ $kajian->judul }}</td>
                                <td class="px-6 py-4 text-slate-300">{{ $kajian->ustadz?->nama ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColor = match ($kajian->status) {
                                            'akan_datang' => 'emerald',
                                            'berlangsung' => 'blue',
                                            'selesai' => 'slate',
                                            default => 'slate'
                                        };
                                        $statusLabel = match ($kajian->status) {
                                            'akan_datang' => 'Akan Datang',
                                            'berlangsung' => 'Berlangsung',
                                            'selesai' => 'Selesai',
                                            default => $kajian->status
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-{{ $statusColor }}-500/20 text-{{ $statusColor }}-400">
                                        <i class="ri-calendar-check-line"></i> {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('users.agenda-kajian.show', $kajian->slug) }}"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-lg text-xs font-medium transition-all duration-200">
                                        <i class="ri-eye-line"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="ri-calendar-event-line text-5xl text-slate-600"></i>
                                        <p class="text-slate-400">Belum ada agenda kajian</p>
                                        <p class="text-slate-500 text-sm">Silakan cek kembali nanti untuk jadwal terbaru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($kajians->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">
                    {{ $kajians->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection