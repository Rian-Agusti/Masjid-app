@extends('layouts.app')

@section('title', 'Jadwal Marbot / Kebersihan')

@section('content')
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-2xl shadow-xl p-6">
        <!-- Header + Tombol PDF & Tambah -->
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold text-white">Jadwal Marbot / Kebersihan</h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.jadwal-marbot.export') }}"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition flex items-center gap-2">
                    Download PDF
                </a>
                <a href="{{ route('admin.jadwal-marbot.create') }}"
                    class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition flex items-center gap-2">
                    <i class="ri-add-line"></i> Tambah Jadwal
                </a>
            </div>
        </div>

        <!-- Form Filter -->
        <form method="GET" class="flex flex-wrap gap-3 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari petugas / tugas..."
                class="flex-1 min-w-[200px] bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder:text-slate-400 focus:ring-2 focus:ring-emerald-500">
            <select name="shift"
                class="bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:ring-2 focus:ring-emerald-500">
                <option value="">-- Semua Shift --</option>
                <option value="Pagi" {{ request('shift') == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                <option value="Siang" {{ request('shift') == 'Siang' ? 'selected' : '' }}>Siang</option>
                <option value="Malam" {{ request('shift') == 'Malam' ? 'selected' : '' }}>Malam</option>
            </select>
            <button type="submit"
                class="px-5 py-2 bg-slate-600 hover:bg-slate-500 text-white rounded-lg transition">Filter</button>
        </form>

        <!-- Tabel Responsive -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-300">
                <thead class="text-xs uppercase bg-slate-700/50 text-slate-200">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Petugas</th>
                        <th class="px-4 py-3">Shift</th>
                        <th class="px-4 py-3">Tugas</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    @forelse($jadwal as $j)
                        <tr class="hover:bg-slate-700/30 transition">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($j->tanggal_piket)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $j->nama_petugas }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                                                                                    {{ $j->shift == 'Pagi' ? 'bg-blue-900 text-blue-200' : '' }}
                                                                                    {{ $j->shift == 'Siang' ? 'bg-yellow-900 text-yellow-200' : '' }}
                                                                                    {{ $j->shift == 'Malam' ? 'bg-purple-900 text-purple-200' : '' }}">
                                    {{ $j->shift }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $j->tugas }}</td>
                            <td class="px-4 py-2 flex gap-3">
                                <a href="{{ route('admin.jadwal-marbot.edit', $j) }}" class="text-blue-400 hover:text-blue-300">
                                    Edit
                                </a>
                                <form action="{{ route('admin.jadwal-marbot.destroy', $j) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-slate-400">Belum ada jadwal marbot.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $jadwal->links() }}
        </div>
    </div>
@endsection