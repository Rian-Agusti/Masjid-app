<?php

namespace App\Http\Controllers;

use App\Models\AgendaKajian;
use App\Models\Ustadz;
use Illuminate\Http\Request;

class AgendaKajianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kajians = AgendaKajian::with('ustadz')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhereHas('ustadz', function ($ustadz) use ($search) {
                            $ustadz->where('nama', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('admin.agenda-kajian.index', compact('kajians'));
    }

    public function create()
    {
        $ustadzs = Ustadz::orderBy('nama')->get();

        return view('admin.agenda-kajian.create', compact('ustadzs'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateKajian($request);

        if ($this->isScheduleConflict($validated)) {
            return back()
                ->withInput()
                ->withErrors([
                    'lokasi' => 'Lokasi sudah digunakan pada rentang waktu tersebut.'
                ]);
        }

        AgendaKajian::create($validated);

        return redirect()
            ->route('admin.agenda-kajian.index')
            ->with('success', 'Agenda kajian berhasil ditambahkan.');
    }

    public function edit(AgendaKajian $agenda_kajian)
    {
        $ustadzs = Ustadz::orderBy('nama')->get();

        return view('admin.agenda-kajian.edit', [
            'kajian' => $agenda_kajian,
            'ustadzs' => $ustadzs,
        ]);
    }

    public function update(Request $request, AgendaKajian $agenda_kajian)
    {
        $validated = $this->validateKajian($request);

        if ($this->isScheduleConflict($validated, $agenda_kajian->id)) {
            return back()
                ->withInput()
                ->withErrors([
                    'lokasi' => 'Lokasi sudah digunakan pada rentang waktu tersebut.'
                ]);
        }

        $agenda_kajian->update($validated);

        return redirect()
            ->route('admin.agenda-kajian.index')
            ->with('success', 'Agenda kajian berhasil diperbarui.');
    }

    public function destroy(AgendaKajian $agenda_kajian)
    {
        $agenda_kajian->delete();

        return redirect()
            ->route('admin.agenda-kajian.index')
            ->with('success', 'Agenda kajian berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    private function validateKajian(Request $request): array
    {
        return $request->validate([
            'judul'         => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'waktu_mulai'   => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi'        => 'required|string|max:255',
            'ustadz_id'     => 'nullable|exists:ustadzs,id',
            'status'        => 'required|in:Terjadwal,Berlangsung,Selesai,Dibatalkan',
            'deskripsi'     => 'nullable|string',
        ]);
    }

    private function isScheduleConflict(array $validated, ?int $ignoreId = null): bool
    {
        return AgendaKajian::where('tanggal', $validated['tanggal'])
            ->where('lokasi', $validated['lokasi'])
            ->when($ignoreId, function ($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->where(function ($query) use ($validated) {
                $query->whereBetween('waktu_mulai', [
                        $validated['waktu_mulai'],
                        $validated['waktu_selesai']
                    ])
                    ->orWhereBetween('waktu_selesai', [
                        $validated['waktu_mulai'],
                        $validated['waktu_selesai']
                    ])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('waktu_mulai', '<=', $validated['waktu_mulai'])
                            ->where('waktu_selesai', '>=', $validated['waktu_selesai']);
                    });
            })
            ->exists();
    }
}
