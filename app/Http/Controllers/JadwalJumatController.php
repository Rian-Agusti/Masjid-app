<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\JadwalJumat;
use Illuminate\Http\Request;

class JadwalJumatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jadwalQuery = JadwalJumat::query();

        if ($search) {
            $jadwalQuery->where('khatib', 'like', "%{$search}%")
                       ->orWhere('imam', 'like', "%{$search}%")
                       ->orWhere('tema_khutbah', 'like', "%{$search}%");
        }

        $jadwal = $jadwalQuery->orderBy('tanggal_jumat', 'desc')
                              ->paginate(10)
                              ->withQueryString();

        return view('admin.jadwal-jumat.index', compact('jadwal'));
    }


    public function create()
    {
        return view('admin.jadwal-jumat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_jumat' => 'required|date',
            'khatib'        => 'required|string|max:255',
            'imam'          => 'required|string|max:255',
            'bilal'         => 'nullable|string|max:255',
            'muadzin'       => 'nullable|string|max:255',
            'tema_khutbah'  => 'nullable|string|max:255',
        ]);

        JadwalJumat::create($validated);

        return redirect()->route('admin.jadwal-jumat.index')
                         ->with('success', 'Jadwal Jumat berhasil ditambahkan.');
    }

    public function show(JadwalJumat $jadwal_jumat)
    {
        return view('admin.jadwal-jumat.show', compact('jadwal_jumat'));
    }

    public function edit(JadwalJumat $jadwal_jumat)
    {
        return view('admin.jadwal-jumat.edit', compact('jadwal_jumat'));
    }

    public function update(Request $request, JadwalJumat $jadwal_jumat)
    {
        $validated = $request->validate([
            'tanggal_jumat' => 'required|date',
            'khatib'        => 'required|string|max:255',
            'imam'          => 'required|string|max:255',
            'bilal'         => 'nullable|string|max:255',
            'muadzin'       => 'nullable|string|max:255',
            'tema_khutbah'  => 'nullable|string|max:255',
        ]);

        $jadwal_jumat->update($validated);

        return redirect()->route('admin.jadwal-jumat.index')
                         ->with('success', 'Jadwal Jumat berhasil diperbarui.');
    }

    public function destroy(JadwalJumat $jadwal_jumat)
    {
        JadwalJumat::destroy($jadwal_jumat->getKey());

        return redirect()->route('admin.jadwal-jumat.index')
                         ->with('success', 'Jadwal Jumat berhasil dihapus.');
    }


    public function export()
    {
        $jadwal = JadwalJumat::orderBy('tanggal_jumat','desc')->get();
        $pdf = Pdf::loadView('admin.jadwal-jumat.pdf', compact('jadwal'));
        return $pdf->download('jadwal-jumat.pdf');
    }

}
