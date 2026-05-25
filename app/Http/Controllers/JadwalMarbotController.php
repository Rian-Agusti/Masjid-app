<?php

namespace App\Http\Controllers;
use App\Models\JadwalMarbot;
use App\Models\JadwalJumat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalMarbotController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $jadwal = JadwalMarbot::when($search, function ($q, $search) {
                $q->where('nama_petugas', 'like', "%{$search}%")
                  ->orWhere('tugas', 'like', "%{$search}%");
            })
            ->orderBy('tanggal_piket', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.jadwal-marbot.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal-marbot.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petugas'  => 'required|string|max:255',
            'tanggal_piket' => 'required|date',
            'shift'         => 'required|in:Pagi,Siang,Malam',
            'tugas'         => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        JadwalMarbot::create($validated);

        return redirect()->route('admin.jadwal-marbot.index')
                         ->with('success', 'Jadwal Marbot berhasil ditambahkan.');
    }

    public function show(JadwalMarbot $jadwal_marbot)
    {
        return view('admin.jadwal-marbot.show', compact('jadwal_marbot'));
    }

    public function edit(JadwalMarbot $jadwal_marbot)
    {
        return view('admin.jadwal-marbot.edit', compact('jadwal_marbot'));
    }

    public function update(Request $request, JadwalMarbot $jadwal_marbot)
    {
        $validated = $request->validate([
            'nama_petugas'  => 'required|string|max:255',
            'tanggal_piket' => 'required|date',
            'shift'         => 'required|in:Pagi,Siang,Malam',
            'tugas'         => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        $jadwal_marbot->update($validated);

        return redirect()->route('admin.jadwal-marbot.index')
                         ->with('success', 'Jadwal Marbot berhasil diperbarui.');
    }

    public function destroy(JadwalMarbot $jadwal_marbot)
    {
        $jadwal_marbot->delete();

        return redirect()->route('admin.jadwal-marbot.index')
                         ->with('success', 'Jadwal Marbot berhasil dihapus.');
    }


    public function export()
    {
        $jadwal = JadwalMarbot::orderBy('tanggal_piket','desc')->get();
        $pdf = Pdf::loadView('admin.jadwal-marbot.pdf', compact('jadwal'));
        return $pdf->download('jadwal-marbot.pdf');
    }

}
