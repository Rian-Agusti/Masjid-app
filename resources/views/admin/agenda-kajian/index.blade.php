@extends('layouts.app')
@section('title', 'Agenda Kajian')
@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-white">Agenda Kajian & Tarbiyah</h2>
                <p class="text-slate-400 text-sm mt-1">Kelola jadwal kajian dan majelis taklim</p>
            </div>
            <a href="{{ route('admin.agenda-kajian.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all shadow-lg shadow-emerald-500/20">
                <i class="ri-add-line text-lg"></i>
                <span>Tambah Kajian</span>
            </a>
        </div>

        <!-- Search -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl p-4">
            <form method="GET" action="{{ route('admin.agenda-kajian.index') }}" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" placeholder="Cari judul, lokasi, atau ustadz..."
                    value="{{ request('search') }}"
                    class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <button type="submit"
                    class="px-5 py-2.5 bg-indigo-500/20 hover:bg-indigo-500 text-indigo-300 hover:text-white rounded-xl transition">
                    <i class="ri-search-line"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.agenda-kajian.index') }}"
                        class="px-5 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-xl transition">Reset</a>
                @endif
            </form>
        </div>

        <!-- Tabel -->
        <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-800/90">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Waktu</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Pemateri</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-slate-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($kajians as $kajian)
                                            <tr class="hover:bg-slate-800/50">
                                                <td class="px-6 py-4 text-white font-medium">{{ $kajian->judul }}</td>
                                                <td class="px-6 py-4 text-slate-300">
                                                    {{ \Carbon\Carbon::parse($kajian->tanggal)->format('d/m/Y') }}</td>
                                                <td class="px-6 py-4 text-slate-300">{{ $kajian->waktu_mulai }} - {{ $kajian->waktu_selesai }}
                                                </td>
                                                <td class="px-6 py-4 text-slate-300">{{ $kajian->lokasi }}</td>
                                                <td class="px-6 py-4 text-slate-300">{{ $kajian->ustadz->nama ?? '-' }}</td>
                                                <td class="px-6 py-4">
                                                    @php $statusColor = match ($kajian->status) {
                                                        'Terjadwal' => 'bg-blue-500/20 text-blue-400',
                                                        'Berlangsung' => 'bg-green-500/20 text-green-400',
                                                        'Selesai' => 'bg-gray-500/20 text-gray-400',
                                                        'Dibatalkan' => 'bg-red-500/20 text-red-400',
                                                    }; @endphp
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusColor }}">
                                                        {{ $kajian->status }}


                                                        </span>
                                                </td>
                                                <td>
                                                    {{ $kajian->deskripsi }}</td>
                                                <td class="px-6 py-4">

                                                          <div class="flex gap-2">
                                                        <a href="{{ route('admin.agenda-kajian.edit', $kajian) }}" class="p-1.5 bg-yellow-500/20 hover:bg-yellow
                              -                                 500 text-yellow-300 hover:text-white rounded-lg" title="Edit">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('admin.agenda-kajian.destroy', $kajian) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                                            @csrf @method('DELETE')
                                                            <button class="p-1.5 bg-red-500/20 hover:bg-red-500 text-red-300 hover:text-white rounded-lg" title="Hapus">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-400">Belum ada agenda kajian</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($kajians->hasPages())
                <div class="border-t border-slate-700 px-6 py-4">{{ $kajians->links() }}</div>
            @endif
        </div>
    </div>
@endsection
