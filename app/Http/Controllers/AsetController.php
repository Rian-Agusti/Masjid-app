<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $asets = Aset::latest()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%')
                      ->orWhere('kategori', 'like', '%'.$search.'%')
                      ->orWhere('deskripsi', 'like', '%'.$search.'%');
            })
            ->paginate(5);

        return view('admin.asets.index', compact('asets'));
    }

    public function create()
    {
        return view('admin.asets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'status'      => 'required|in:Baik,Perlu Perbaikan,Rusak',
            'deskripsi'   => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Aset::create($validated);

        return redirect()->route('admin.asets.index')
            ->with('success', 'Aset berhasil ditambahkan.');
    }

    public function show(Aset $aset)
    {
        return view('admin.asets.show', compact('aset'));
    }

    public function edit(Aset $aset)
    {
        return view('admin.asets.edit', compact('aset'));
    }

    public function update(Request $request, Aset $aset)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'nullable|string|max:255',
            'status'      => 'required|in:Baik,Perlu Perbaikan,Rusak',
            'deskripsi'   => 'nullable|string',
        ]);

        $aset->update($validated);

        return redirect()->route('admin.asets.index')
            ->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();

        return redirect()->route('admin.asets.index')
            ->with('success', 'Aset berhasil dihapus.');
    }

    public function exportPdf()
    {
        $asets = Aset::latest()->get();

        $pdf = Pdf::loadView('admin.asets.pdf', compact('asets'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-aset-'.now()->format('Y-m-d').'.pdf');
    }
}
