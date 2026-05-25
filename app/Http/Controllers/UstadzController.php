<?php

namespace App\Http\Controllers;

use App\Models\Ustadz;
use Illuminate\Http\Request;

class UstadzController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $ustadzs = Ustadz::when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%')
                      ->orWhere('topik_keahlian', 'like', '%'.$search.'%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.ustadz.index', compact('ustadzs'));
    }

    public function create()
    {
        return view('admin.ustadz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'topik_keahlian' => 'nullable|string|max:255',
            'kontak'         => 'nullable|string|max:255',
        ]);

        Ustadz::create($validated);

        return redirect()->route('admin.ustadz.index')
            ->with('success', 'Ustadz berhasil ditambahkan.');
    }

    public function edit(Ustadz $ustadz)
    {
        return view('admin.ustadz.edit', compact('ustadz'));
    }

    public function update(Request $request, Ustadz $ustadz)
    {
        $validated = $request->validate([
            'nama'           => 'required|string|max:255',
            'topik_keahlian' => 'nullable|string|max:255',
            'kontak'         => 'nullable|string|max:255',
        ]);

        $ustadz->update($validated);

        return redirect()->route('admin.ustadz.index')
            ->with('success', 'Ustadz berhasil diperbarui.');
    }

    public function destroy(Ustadz $ustadz)
    {
        $ustadz->delete();

        return redirect()->route('admin.ustadz.index')
            ->with('success', 'Ustadz berhasil dihapus.');
    }
}
